# TajawalAPIs

- What's this Repo ?
 It's a REST API for restore and search hotels by name, city, price range and availability range. 
 This project is based on php7.1 and symfony4. 
 
 Installation :
 
 - Clone this Repo using : git clone https://github.com/ahmedsamir89/TajawalAPIs.git
 - go to TajawalAPIs file and run composer install
 - run php bin/console server:run
 - go to http://127.0.0.1:8000/api/hotels you should find the hotels Response
 - you can run unit tests with : php bin/phpunit
 
 Documentation:
 - This APIs return all hotels and you can sort and filter them As following: 
   - use /api/hotels to retrieve all hotels 
   - use /api/hotels?name=xx to get the hotels with name xx
   - use /api/hotels?city=xx to get the hotels on city xx
   - use /api/hotels?price_from=11&price_to=15 to select hotels prices between 11 and 15
   - use /api/hotels?available_from=date1&available_from=date2 to select hotels prices between date1 and date2
   - use /api/hotels?sort_by=price to sort hotels by price (DESC) 
   - name and city only accept text
   - price_from and price_to only accept floats 
   - available_from and available_to only accept dates on format (dd-MM-yyyy)
   - sorting is only allowed by price and name
   
Examples:

  - Sucess:
    - request: http://127.0.0.1:8000/api/hotels?price_from=100&price_to=105
    - response: 
        {"success":true,"hotels":[{"name":"Media One Hotel","price":102.2,"city":"dubai","availability":[{"from":"10-10-2020","to":"15-10-2020"},{"from":"25-10-2020","to":"15-11-2020"},{"from":"10-12-2020","to":"15-12-2020"}]}]}
 - failure:
    - request: http://127.0.0.1:8000/api/hotels?price_to=sss
    - reponse: 
        {"success":false,"errors":{"price_to":["This value is not valid."]}}
      




 
 

