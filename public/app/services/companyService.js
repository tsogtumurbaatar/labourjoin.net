app.service('companyService', ['$http', function($http){

    this.listCompanies = function(){
      return $http.get("http://localhost/greenstaff/public/api/companies");
    };


    this.removeCompany = function(company){
      return $http.post("http://localhost/greenstaff/public/api/companiesdelete",{
        'id': company.id
      });
    };

    this.getInfo = function(requst_id){
      return $http.post("http://localhost/greenstaff/public/api/infoforworker",{
        'id': requst_id
      });
    };

    this.addCompany = function(newworker){
     return $http.post("http://localhost/greenstaff/public/api/companies",{
        'name' : newworker.name,
        'email' : newworker.email,
        'password' : newworker.password,
        'address' : newworker.address,
        'phone1' : newworker.phone1,
        'phone2' : newworker.phone2,
        'company_fax' : newworker.company_fax,
        'company_email2' : newworker.company_email2,
        'company_abn' : newworker.company_abn,
        'company_busname' : newworker.company_busname,
        'user_info' : newworker.user_info
 });
   };

   this.saveCompany = function(newworker){
        return  $http.post("http://localhost/greenstaff/public/api/companiesput",{
        'id' : newworker.id,
        'name' : newworker.name,
        'email' : newworker.email,
        'password' : newworker.password,
        'address' : newworker.address,
        'phone1' : newworker.phone1,
        'phone2' : newworker.phone2,
        'company_fax' : newworker.company_fax,
        'company_email2' : newworker.company_email2,
        'company_abn' : newworker.company_abn,
        'company_busname' : newworker.company_busname,
        'user_info' : newworker.user_info
     });
   };

  this.changeCompany = function(newcompany){
     return  $http.post("http://localhost/greenstaff/public/api/companieschange",{
        'id' : newcompany.id,
     });
   };
 }]);