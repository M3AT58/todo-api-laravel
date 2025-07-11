Laravel ToDo API

This is a simple ToDo list API built with **Laravel ** using authentication. It covers the basics: registration, login, logout, and full CRUD for user-owned todos.

Features
- User registration & login
- Logout
- Create, Read, Update, Delete todos
- Request validation with FormRequest classes
- API Resource classes for clean, consistent JSON responses
- Pagination on todo listing

---

Endpoints (Examples)
 Method | URL              | Description          

 POST    `/api/register`   Register new user    
 POST    `/api/login`      Login and get token  
 POST    `/api/logout`     Logout (auth token)  
 GET     `/api/todos`      Get user's todos     
 POST    `/api/todos`      Create todo          
 PUT     `/api/todos/{id}` Update todo          
 DELETE  `/api/todos/{id}` Delete todo          

---

Still To Improve
- Add filtering and sorting for todos
- Improve error handling structure
- add tags
