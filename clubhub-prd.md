# ClubHub PRD

## 1. Overview

ClubHub is a full-stack web-based platform designed to centralize and streamline the management and engagement of campus clubs and societies at Sunway University. It serves students, club organizers, and university administrators by offering a single interface to manage student clubs, events, and venue bookings. ClubHub simplifies the process of discovering, joining, and managing organizations while streamlining event participation and approvals through role-based access.

## 2. Objectives

The primary objective of ClubHub is to simplify and enhance extracurricular engagement and event planning in a university setting by overcoming the inefficiencies of fragmented, paper-based, and social media-reliant systems.

### Goals:

1. Provide a unified platform for campus-wide club and society engagement.
2. Eliminate manual paperwork and scattered email communications for event approvals.
3. Simplify venue booking with real-time availability.
4. Deliver an intuitive interface with AI chatbot assistance.

## 3. Target Users

* **Students (@imail.sunway.edu.my)**

  * View clubs and events (public access, no login required).
  * Register for club memberships and events.

* **Club Admins (@imail.sunway.edu.my)**

  * Create/manage club events.
  * Submit event proposals.
  * Book venues.

* **University Admins (@sunway.edu.my)**

  * Review and approve events and venue bookings.

Reference for UI: [Sunway Student Organisations](https://student.sunway.edu.my/campus-life/student-organisations)

## 4. Tech Stack

* XAMPP v3.3.0
* PHP
* MySQL Database
* HTML, CSS, JavaScript
* Ajax, jQuery
* Bootstrap
* Google Material Icon
* Material Kit 2 Template

## 5. System Features

### Public-Side (No Login Required)

* **Home Page:** Welcome message and intro.
* **About Page**
* **Clubs Page**

  * List all active clubs.
  * Search by keyword/category.
  * View club details (About Us, contacts).
* **Club Membership Page**

  * Submit membership application form.
* **Events Page**

  * List of upcoming events.
  * View event details (title, date, time, venue).
  * Event registration form.
* **Login / Logout**

### Club Admin Panel

* **Dashboard:** Summary view.
* **Club Membership Application Management**

  * Update membership application status (Pending/ Confirmed/ Approved/ Declined)
  * Add New membership Application/ View membership Applications list/ Edit membership Application Details/ Delete membership Application
* **Event Management** **(CRUD)**

  * Add new events (Event details: title, date, time, venue)/ List All Event Details/ View Event Details/ Edit Event Details/ Delete Event Details
* **Event Registration Management**

  * List / View / Edit Event registrations. (from registrations made by users on public side)
* **Event Application** (Club admin to submit event applications to university admin for approval)

  * Submit new application for approval.
  * List / View / Edit / Delete applications.
  * Club admin to Book venues based on availability - dropdown option to choose which venues to book + calendar (date/time/year)
* **Account Management**

  * Update credentials.
* **Login / Logout**

### University Admin (Admin/ Staff) Panel

* **Dashboard:** Summary view.

* **Club Management (CRUD)**

  * Add New Club/ View List of Clubs/ Edit Club Details/ Delete Club

* **User Management (CRUD)**

  * Only admin can register new club admin/staff.
  * Add New User/ View Users List/ Edit User Details/ Delete Users

* **Club Membership Application Management**

  * Add New Application List/ View Application List/ Edit Application Details/ Delete club membership applications

* **Event Management**

  * View Event Application List/ Edit event applications (Manage application: Approve/ Decline/ Pending)
  * Event Venue Booking 

    * List venue bookings.
    * Manage venue bookings: (Approve/ decline/ pending)

* **System Settings**

  * Update platform info and assets (e.g., logo).

* **Account Management**

  * Update credentials.

* **Login / Logout**

## 6. Role-Based Access and Auth

* **Students:** Public access to clubs/events, no login.
* **Club Admins:** log in with @imail.sunway.edu.my; access `/club_admin/` routes only. (show message if email entered in login does not end with @imail.sunway.edu.my)
* **University Admins:** log in with @sunway.edu.my; access `/admin/` routes only. (show message if email entered in login does not end with @sunway.edu.my)


