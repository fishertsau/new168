#What should we do for device?
- New a device
- Edit a device
- Delete a device
- Deactivate a device
- Query devices
- Collect devices
- Contact the Device Seller

//device creation
x only verified account is allowed to create a device
warning message shown when unverified account tries to create a device
an verified account can create at most 10 devices
an unverified account can create at most 3 devices
an warning message is shown when an unverified account 
 tries to create more than 3 devices

//device crud
x an account can edit a device
x an account can update a device
x an account can delete a device
a notice is shown when after a device is deleted
x non-owner is not allowed to delete, edit, update a device(redirect)
x only verified account is allowed to delete, edit, update a device
a warning message is shown when a unverified account try to crud a device
a device is default to be published
an account can unpublish/publish a device
only owner is allowed to publish/unpublish a device
only verified account is allowed to publish/unpublish a device
(repo?) associated info is automatically deleted when a device is deleted
x redirected to login when an unsignIn user tyring to create,edit,or update a device


//show
x user can see the detail information of a device
user can do facebook share for a device
user can do line share for a device
x device read-count is incremented by one when clicked from the frontend 
x a device can show its read-count
user can send email to the seller
an account can collect device as his favorite
an account can remove a device from his favorite collection
only owner can see over-due devices from frontend
x only owner can see unpublished device from frontend


//device query
x user can query devices with keyword for device name
x user can query devices with locations: city, zips
x user can query devices with category
x user can query devices with price range
x user can query devices with one occasion
x user can query devices with gas type
x user can query devices with voltage
x user can change page number when view querying result
x user can sort device query by price, created date, reads
user can see all its query term when doing query
x only published devices could be queried from the frontend
only devices within due could be queried from the frontend


//admin
x unpublished devices could be queried from the backend
overdue devices could be queried form the backend
authorized persons can deactivate a device from admin
only authorized persons can do crud of a device from admin

//due
device is de-activated one month after updated or extended
devices are automatically unpublished when not updated for one month



//photo
account can upload cover photo for a device


//留言