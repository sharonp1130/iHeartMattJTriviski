#!/usr/bin/env python

import requests
import json
import random
import time

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
            start = "08:00:00"
            end = "17:00:00"
        else:
            start = None
            end = None
    
        avail["%sStart" % day] = start
        avail["%sEnd" % day] = end

    return avail
    
    
def gen_license(service=None):
    return {"licenseNumber" : "%s-%d" % (get_word(), long(time.time() % random.randint(1, 999))),
            "service" : service if service is not None and service in services else get_service()
            }
        

if __name__ == "__main__":
    import datetime as dt
    st = dt.datetime.now()

    nums = int(100)

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
        for _ in range(random.randint(1, len(services))):
            service = random.choice(services)
            
            if service in added:
                while service in added:
                    service = random.choice(services)
                
            added.append(service)
                
            r = requests.put(license_url % uid, json=gen_license(service))
            print r.text
            
            
        #Add some locations here.
        r = requests.post(location_url % uid, json=dict(longitude=1, latitude=1))

            
    print "Number records=%5d took %s" % (nums, dt.datetime.now() - st)

         
         
#     r = requests.get(url_root + "/query/service/heating", params=dict(longitude=1234, latitude=2345, distance=5, usersToSkip="4,5,10..15,18"))
#     print r.json()



