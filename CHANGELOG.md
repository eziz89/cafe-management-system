# Changelog

All notable changes to this project will be documented in this file.

---

## [0.3.0] - 2026-07-10

### Added

* Complete admin panel MVP
* Live search for dishes, orders, and reservations
* Live pagination across admin pages
* Live status updates for dishes, orders, and reservations
* Category dishes page
* Checkout page with customer information
* Order history and reorder functionality
* Reusable Blade components for filters and tables

### Changed

* Refactored JavaScript into separate `app.js` and `admin.js`
* Improved admin UI and navigation
* Made category rows clickable
* Improved checkout flow

### Fixed

* AJAX pagination issues
* Category dish sorting
* Live filtering bugs
* Status update synchronization

---

## [0.2.0]

### Added

* Orders management
* Reservations management
* Categories management
* Admin dashboard
* CRUD operations for dishes

---

## [0.1.0]

### Added

* Initial Laravel project
* Authentication
* Restaurant menu
* Shopping cart
* Favorite dishes

## [Unreleased]

### Added
- Customer checkout page with address, payment and order type.
- Reorder now prefills checkout information.
- Redesigned order success page.
- Redesigned My Orders page.
- Redesigned Order Details page.
- Live order status polling without page refresh.
- Reusable status badge and timeline components.

### Improved
- Customer order experience.
- Checkout validation.
- Blade partial organization.