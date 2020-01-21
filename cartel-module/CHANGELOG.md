# Changelog
All notable changes to this project will be documented in this file.

## [1.8.3] - 19-03-2019
### Changed
- PUC to version 4.5
- Function naming of PUC

## [1.8.1] - 18-03-2019
### Added
- Added Build year filter
- Added Sort filter
- Added KM filter 
- Added some Documentation 

## [1.8] - 18-03-2019
### Added
- Call me now contact page.
- Auto update Checker.

## [1.7]
### Changed
- Overhaul of the Offer Content Module.

## [1.6]
### Added
- Weekly content view.

### Removed
- List view on Offer Content Widget.

## [1.5.3]
### Fixed
- Now the 404 status code is only generated on the detail page.

## [1.5.2]
### Fixed
- Now the "No car found page" correctly gives the 404 status code.

### Changed
- Allow the customer to set the target-url without the site_url present.
- Improved checking of the required fields in Visual Composer.

## [1.5.1]
### Added
- Mapper and Getter overruled eachother, fixed this.
### Fixed
- Financial Lease.

## [1.5]
### Added
- Open Graph tags for Social Media.

### Fixed
- Proper enqueing of scripts in the backend.
- Enqueing of scripts on the Front-end, improved the proces.

### Removed
- Option that holds the version number, was doing nothing.

## [1.4]
### Added
- On activation of the plugin, already filling the caw4_url option in the database.
- JS Functionality to see if the required fields(ccid and cawurl) are set.
- Save the title of the car in de database so the page title is correctly rendered for Google.
- WP Cron function to delete car's that haven't been visited in the past month.
- Added the possibility to prefill bodytype.

### Fixed
- Removed multiple exit statements if car's aren't found in the Offer widget which broke the rest of the page.
- Caw Offer widget now renders a proper notification if the results is 0.
- Overhaul of the render functionality to get lesser code.
- Removed the var $defaults in the Visual Compser class to avoid notices.
- Code improvements to fix PHP notices.

### Removed
- Instance function, improved the loading process.

## [1.3]
### Added
- Expanded search options

## [1.2]
### Fixed
- Fixed multiple bugs

## [1.1]
### Added
- Method to search on models with a custom widget (Greep uit ons aanbod).

## [1.0]
### Added
- Initial version