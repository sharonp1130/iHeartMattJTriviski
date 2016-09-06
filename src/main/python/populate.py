#!/usr/bin/env python

import requests
import json
import random
import time
import sys
import multiprocessing as MP

url_root = "http://192.241.195.224:8080/api"
url_root = "http://localhost:8080/api"
user_url = url_root + "/user"
user_get = user_url + "/%d"
info_url = url_root + "/user/%d/info"
availability_url = url_root + "/user/%d/availability"
license_url = url_root + "/user/%d/license"

location_url = url_root + "/location/%d"

words = [word.strip() for word in open("/usr/share/dict/words")]
services = ["electrical", "plumbing", "heating", "general", "roofing"]

get_word = lambda: random.choice(words)
get_int = lambda maxInt: random.randint(0, maxInt)
get_service = lambda: random.choice(services)
get_bool = lambda: long(time.time()) % random.randint(1, 10) == 0

get_latitude = lambda: random.uniform(34.1, 34.2)
get_longitude = lambda: random.uniform(-118.2, -118.1)
                                
def gen_user():
    return {
            "email" : "%s@%s.com" % (get_word(), get_word()),
            "firstName" : get_word(),
            "lastName" : get_word(),
            "isProvider" : "true" 
           }
    

def gen_info():
    return {
            "businessName" : "%s associates" % get_word(),
            "address" : "%d %s street" % (get_int(9999), get_word()),
            "city" : get_word(),
            "zipcode" : "%05d" % get_int(99999),
            "phone" : "(%03d) %03d-%04d" % (get_int(999), get_int(999), get_int(9999)),
            "phoneOk" : "true" if get_bool() else "false",
            "textOk" : "true" if get_bool() else "false",
            "emailOk" : "true" if get_bool() else "false",
            }

def gen_avail():
    avail = {}
    
    for day in ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]:
        if get_bool():
            start = "8"
            end = "17"
        else:
            start = None
            end = None
    
        avail["%sStart" % day] = start
        avail["%sEnd" % day] = end

    return avail
    
    
def gen_license(service=None):
    sn = service if service is not None and service in services else get_service()
    ld = sn + " a long description"

    return {"licenseNumber" : "%s-%d" % (get_word(), long(time.time() % random.randint(1, 999))),
            "service" : dict(serviceName=sn, longDescription=ld)
            }
#     return {"licenseNumber" : "%s-%d" % (get_word(), long(time.time() % random.randint(1, 999))),
#             "serviceName" : service if service is not None and service in services else get_service()
#             }
        
def do_run(nums=100, num_locs=2):
    import datetime as dt
    st = dt.datetime.now()

    for _ in xrange(0, nums):
        user = gen_user()
        info = gen_info()
        avail = gen_avail()
        license = gen_license()

        # add the user.
        r = requests.put(user_url, json=user)

        # add the users info.
        u = r.json()
        uid = u.get("userId")

        r = requests.post(info_url % uid, json=info)
        inf = r.json()

        r = requests.post(availability_url % uid, json=avail)
        av = r.json()
     
        added = []
        for _ in range(random.randint(2, len(services))):
            service = random.choice(services)
            
            if service in added:
                while service in added:
                    service = random.choice(services)
                
            added.append(service)
                
            r = requests.put(license_url % uid, json=gen_license(service))

        import time
        for _ in range(0, num_locs):
            #Add some locations here.
            r = requests.post(location_url % uid, json=dict(longitude=get_longitude(), latitude=get_latitude()))

            
    print "Number records=%5d took %s" % (nums, dt.datetime.now() - st)


def update_settings(user_id, update=False):
    r = requests.get(availability_url % user_id)
    av = r.json()
    
    if update:
        for k, v in av.items():
            if v is None:
                av[k] = 8 if "Start" in k else 17

    print av
    if update:
        r = requests.post(availability_url % user_id, json=av)

if __name__ == "__main__":
    import datetime as dt
    st = dt.datetime.now()

    thread_count = 4
    user_to_add = 4
    
    procs = []
    
    for _ in range(thread_count):
        p = MP.Process(target=do_run, args=(user_to_add/thread_count,))
        procs.append(p)
    
    for p in procs:
        p.start()
    
    for p in procs:
        p.join()

#     update_settings(1, True)
#     update_settings(1)
     
   
    print "Number records=%5d took %s" % (user_to_add, dt.datetime.now() - st)