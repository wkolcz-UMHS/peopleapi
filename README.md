<p align="center"><a href="https://www.flex-n-gate.com/" target="_blank"><img src="https://www.flex-n-gate.com/img/FNG_Logo.svg" width="400"></a></p>



## About People API

To set up the People API, create a database called 'peopleapi', then run the following commands:
- php artisan migrate
- php artisan data:populate



## Accounts

Demo application comes with 2 accounts
- admin@testdemo.com / demoadmin
- user@testdemo.com / demo


## Routes

All routes are versioned for future proofing with a v1 perfix and include
- Public Routes
    - (POST) /authenticate - which takes a json object of 'user' with 'email' and 'password', return json with user_id, token
- Private Routes
    - Fetch all
        - (get) /api/v1/applicants
    - Fetch individual applicat by id
        - (get) /api/v1/applicant/[id]
    - Search applicant by name, and page. Defaults to 0
        - (get) /api/v1/applicant/search/[name]/[status]/[page]
            - status ['all','open','interviewing','contacted','rejected']
            - page 0,1,2
    - Update applicant
        - (post) /api/v1/applicant/[id]
            - takes a json object of 'info' that includes string 'name', integer 'position_id', string 'status', integer 'created_by'
    - Create new applicant
        - (post) /api/v1/applicant
            - takes a json object of 'info' that includes string 'name', integer 'position_id', string 'status', integer 'created_by'
    - Delete applicant record
        - (delete) /api/v1/applicant/[id] - Secure for only admins

## Contact
You can contact me @ <a href="mailto:wkolcz@gmail.com">wkolcz@gmail.com</a> if you have any questions or issues

