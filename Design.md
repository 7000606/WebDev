
# Project Overview

This PHP website will be an ecommerce site to sell handmade star wars memorabilia.

## User Management
Users will be able to log in, log out, reset their passwords, and edit their details.

Users will need to store:
- Name
- DOB
- Hashed password
- Access Level (user vs Administrator)
- Status (active or disabled)
-Quantity 

# Project Overview

This PHP website will be an ecommerce site to sell handmade star wars memorabilia.

## User Management
Users will be able to log in, log out, reset their passwords, and edit their details.

Users will need to store:
- Name
- DOB
- Hashed password
- Access Level (user vs Administrator)
- Status (active or disabled)
## Product management 

Administration will be able to add, remove, edit products.

Product will have: 
- A name 
- A price 
- A description 
- Quantity 

# Behavior User Journey

```mermaid
journey
title User Journey
    section Login
        section Login
        Load main (home) page: 5: Unauthenticated User
        Enter login details: 5: Unauthenticated User
        Press Login Button: 5: Unauthenticated User
    section Registered
        Perform site Actions:5: Authenticated User
    section Logoff
        Press Logoff Button in Navbar:5: Authenticated User
        Close Browser:5: Unauthenticated User
```