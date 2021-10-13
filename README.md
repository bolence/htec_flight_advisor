<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About project

This project is developed for testing purpose and employment for HTEC company. Project description:

Create Flight advisor API for finding the cheapest flights. There are two types of the users: administrator and regular user.
Every user has: first name, last name, user name, password and salt.
The regular user has to register in order to be able to use a Flight advisor.

The administrator is able to:
- Add cities. 
For each city, the name, country and description must be provided.

Regular user can:
- Get all the cities (all the comments should be returned, or if specified, only the x latest comments).
- Search for cities by name (all the comments should be returned, or if specified, only the x latest comments).
- Add a comment for the city.
- Delete a comment .
- Update a comment.

Besides comment’s description, each comment should have created and modified date.
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
