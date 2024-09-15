import requests
from concurrent.futures import ThreadPoolExecutor

url = "http://locauto.test/test"

application_ids = ["app1", "app2", "app3"]

def make_request(application_id):
    headers = {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "X-Application-ID": application_id
    }

    response = requests.get(url, headers=headers)

    request_raw = f"Method: {response.request.method}\n" \
                  f"URL: {response.request.url}\n" \
                  f"Headers: {response.request.headers}\n" \
                  f"Body: {response.request.body}"

    print(f"X-Application-ID: {application_id}")
    print("Request Raw:")
    print(request_raw)
    print("Response Body:")
    print(response.json())

number_of_requests = 3

with ThreadPoolExecutor(max_workers=number_of_requests) as executor:
    executor.map(make_request, application_ids)
