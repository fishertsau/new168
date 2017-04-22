使用者需求

# What should we build for vendor introduction?
- Create vendor
- Edit vendor
- View a vendor through browser
- Query a vendor
- Create hottest news (?)
- Send email to this vendor (?)


Demand for vendor:
//middleware
x only verified account can create a vendor
x only verified account can update a vendor
x only the owner can update a vendor from frontend
x only the owner can edit a vendor through browser from frontend
the owner can decide whether to publish the vendor


<br>
only the published vendors could be queried as a list view from the frontend
only the owner could see the unpublished vendor in detail view from the frontend
all vendors could be queried as a list view from the backend
all vendors could be seen from the backend
(?)each vendor has a unique title


<br>
//vendor CRUD
x a company_type is default as normal if not specified
x an account has no vendor if no a vendor is created
x an account can create at most one vendor
x each vendor has unique serial number
x a vendor could not be deleted
vendor info update process should be recorded
the update log could be seen from the backend
the update log could be seen by the owner from the frontend


<br>
//admin authority: crud activated
only authorized persons could update a vendor from admin
only authorized persons could see the vendor
all update activities should be recorded
the authorized system users can activate and deactivate a vendor from admin
only the authorized persons could see the vendor-mgnt function


//service
the authorized persons could create a vendor for an account
no any account could be created from the backend

<br>
//frequent and unFrequent-use
x a vendor could know its frequent-use count
x a vendor can know its frequent-use followers


<br>
//major products
a vendor can add arbitrary number of products it offers
a vendor can update product content it owns
a vendor can deactivate a product if owns
a vendor can remove vendor products it owns
each vendor product could upload its cover photo
a product photo is removed when the product is removed
vendor products are removed when the vendor is deleted


<br>
//major services
a vendor can add arbitrary number of services it offers
a vendor can update service content it owns
a vendor can remove vendor services it owns


<br>
//contacts
a vendor can add arbitrary number of contacts
a vendor can edit contacts it owns
a vendor can remove contacts it owns


<br>
//address
a vendor can create its addresses
a vendor can have arbitrary number of addresses
a vendor can update its address
a vendor can remove its address


<br>
//vendor maintenance service
a vendor can specify whether it provides maintenance service
a vendor can specify device types that it can maintain


<br>
//photo uploads
x a vendor can upload its coverPhoto
a vendor can upload at most 10 photos for introduction

<br>
//vendor verification
simple verification: a vendor is simple verified when required information is provided
simple unVerification: a vendor become unVerified when required information is deleted
complete verification: vendor info is correct or certificate-certified/manual verified
complete verification log: only needed for complete verification

<br>
//vendor category
?? The query mechanism should be discussed further
x an account can choose vendor type when creating and updating (personal/small vendor/...?)
? a vendor can choose which category it belongs (not clear)
a vendor can note it category if no any pre-defined categories are appropriate
? a vendor's category criteria is decided by the vendor type it specifies

<br>
//device vendor query
device vendors could be queried with keyword: name, service, main products
device vendors could be queried with category
device vendors could be queried with location
device vendors could be queried with service areas
device vendors could be queried with maintenance capability
a vendor could be queried even if it has more than one address

<br>
//authority regarding device post
//an verified account can post up to 5 devices
//an account with simple verified vendor can post up to 20 devices free of charge
//a verified vendor who is premium member can post up to 50 devices

<br>
//vendor introduction view
. basic info
. main products
. main services
. on-sell devices
. fb share
. line share