#What can we do with a Discussion in Device?
>Here we describe what a discussion should do?

- Raise Discussion
- Cease Discussion
- Join Discussion
- Leave Discussion
- Send Necessary notification in some situation


##Notification
x - an event is fired when a discussion is raised
- a notification is sent to the model owner if the associated model is 'device'
- an notification message is sent to the Model owner when someone joined a discussion (is this necessary?)
- the notification content can change according to the requirement, e.g. Device/HouseRental
    - (通知的內容 應該隨著需求不同而變, e.g. 詢問設備, 出租地點,等等)
    - TODO:: [需要想一下如何測試...]
    - 有可能也不需要寄出通知
    - 可以利用model來決定動作



##Raise and cease discussion
### Raise
x - an account can raise discussion regarding a model
x - content is required to raise the discussion
x- only the sign in user is allowed to raise a discussion
- redirect to the login page when a unSigned-in user try to raise discussion (frontend)

### Cease
x- an account can cease discussion
x- only the owner can cease the discussion
- all discussion-associated dialogues are removed when discussion is ceased


##Join and leave discussion
###Join
- an account an join discussion
- content is required to join the discussion
- only sign-in user can join the discussion
- redirect to the login page when unSigned-in user try to join discussion 

###Leave
- an account can leave the discussion
- an account can only leave his discussion

##Discussion Retrieving
- A discussion can retrieve all associated dialogues
- The Discussionable Model can retrieve all its discussions and dialogue

