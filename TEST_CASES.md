TC-001
Login as SuperAdmin
Expected:
Dashboard loads successfully

TC-002
Logout
Expected:
Redirect to login page

TC-003
Login as SuperAdmin

Invite:

admin@companya.com

Role:
Admin

Expected:
Invitation created
Company created
Email logged

TC-004
Open invitation URL

Create account

Expected:
User created
Admin role assigned
Company assigned
Invitation accepted

TC-005
Login as Admin

Invite:

member@companya.com

Role:
Member

Expected:
Invitation created
Same company assigned

TC-006
Login as Member

Try:

/invitations/create

Expected:
403 Forbidden

TC-007
Login as Admin

Create URL

https://google.com

Expected:
Short URL created

TC-008
Login as Member

Create URL

https://laravel.com

Expected:
Short URL created

TC-009
Login as SuperAdmin

Visit

/short-urls/create

Expected:
403 Forbidden

TC-010
Login as SuperAdmin

Expected:
See all URLs

TC-011
Login as Admin

Expected:
See company URLs only

TC-012
Login as Member

Expected:
See own URLs only

TC-013
Open:

/s/{shortCode}

Expected:
Redirect to original URL

TC-014
Open same URL multiple times

Expected:
Hits increment

TC-015
Member access invitation screen

Expected:
403

TC-016
SuperAdmin access URL creation screen

Expected:
403
