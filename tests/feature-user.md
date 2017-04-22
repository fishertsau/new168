# What can an user do?
> Here we decide appropriate behaviors a user can have to his/her own account. 

## basic actions
- register account
    + in site registration
        - validation
    - Facebook registration
    - (tbd) welcome email 
- logout
- login
- each account has unique email address
+ signIn record
    - stamp signIn


## account validation
+ email validation
    + account creation
        - an account is unverified when initially registered
        - a confirmation email is sent after an account is registered
        - an email-confirmation notice is pupped up to the user right after account registration
    + login notice
        - a notice is given at login if unVerified 
    + email changed
        - the account is unVerified if email changed
        - a confirmation email is sent after email changed
        - an email-confirmation notice is pupped up after email changed
    + validation    
        - an account is validated when the validation link in email is hit
        - a validation done message is shown to the user when verified successfully 
    + confirmation email 
        - an user can request to send the confirmation email again
        - an user whose account is validated can not request to send a new confirmation email

+ sms + token(6 digits)


## account activity
- account profile
    + update
       - change password 
       - update account profile
       - duplicate email is not allowed for update
       - update avatar
    - see profile
        - update log

- password handling
    + forget password
    + reset password


## advance ability
- Devices
    - see post devices list
    - see likes devices

- Supplier
   - the auth account could frequent or unFrequent a company
   - create
   - edit
   - see
        - revision record