#!/usr/bin/env python

from populate import *
import requests

if __name__ == "__main__":
    locations_to_add = 1
    up_to = 100
    
    added = 0
    
    for _ in range(locations_to_add):
        added += 1
        
        for uid in range(1, up_to):
            r = requests.post(location_url % uid, json=dict(longitude=get_longitude(), latitude=get_latitude()))