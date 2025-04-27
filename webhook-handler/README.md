
## About Webhook Handler
Webhook Handler is a Laravel-based microservice designed to handle and process webhooks from Google services and Apple services (Although I have used dummy responsese, similar approach can be used for real data). 

- Built with clean architecture in mind, it utilizes Data Transfer Objects (DTOs) alongside a data mapper to ensure consistent and validated data transformation. 
- A dedicated data forwarder component allows seamless forwarding of processed data to other internal services or endpoints. 
- The project is fully tested with both unit and feature tests using the Pest testing framework. 


## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
