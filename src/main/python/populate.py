#!/usr/bin/env python

import requests

url_root = "http://192.241.195.224:8080/api"
url_root = "http://localhost:9090/api"
user_url = url_root + "/user"
user_get = user_url + "/%d"
info_url = url_root + "/user/%d/info"
availability_url = url_root + "/user/%d/availability"
license_url = url_root + "/user/%d/license"

location_url = url_root + "/location/%d"

user = {
  "email" : "poopy@gmail.com",
  "firstName" : "sam",
  "lastName" : "johnson",
  "isProvider" : "true"
}

info = {
  "businessName" : "my business 222",
  "address" : "new business address",
  "city" : "st. paul",
  "zipcode" : "12345",
  "phone" : "(818) 112-1345",
  "phoneOk" : "true",
  "textOk" : "true",
  "emailOk" : "true"
}

avail = {
  "mondayStart" : None,
  "mondayEnd" : "00:00:31",
  "tuesdayStart" : None,
  "tuesdayEnd" : None,
  "wednesdayStart" : None,
  "wednesdayEnd" : None,
  "thursdayStart" : None,
  "thursdayEnd" : None,
  "fridayStart" : None,
  "fridayEnd" : None,
  "saturdayStart" : None,
  "saturdayEnd" : None,
  "sundayStart" : None,
  "sundayEnd" : "12:00:00"
}

licenses = [  {
    "licenseNumber": "GENPOP",
    "service": "general"
  },
   {
    "licenseNumber": "HEATERMAN",
    "service": "heating"
  }           ]

# add the user.
r = requests.put(user_url, json=user)
# add the users info.
u = r.json()
uid = u.get("userId")
r = requests.post(info_url % uid, json=info)
inf = r.json()
r = requests.post(availability_url % uid, json=avail)
av = r.json()

for license in licenses:
    r = requests.put(license_url % uid, json=license)
    print r.json()
    
    
r = requests.get(url_root + "/query/service/heating", params=dict(longitude=1234, latitude=2345, distance=5, usersToSkip="4,5,10..15,18"))
print r.json()



