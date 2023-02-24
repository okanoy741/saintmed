using System;  
using System.Linq;  
using System.Web;  
using System.Web.Mvc;  
using System.Collections.Generic;  
  
namespace Cascading_DropDownList_AngularJS_MVC.Controllers  
{  
    public class HomeController : Controller  
    {  
        // GET: Home  
        public ActionResult Index()  
        {  
            return View();  
        }  
  
        [HttpPost]  
        public JsonResult AjaxMethod(string type, int value)  
        {  
            List<SelectListItem> items = new List<SelectListItem>();  
            CascadingEntities entities = new CascadingEntities();  
              
            switch (type)  
            {  
                default:  
                    foreach (var country in entities.Countries)  
                    {  
                        items.Add(new SelectListItem { Text = country.CountryName, Value = country.CountryId.ToString() });  
                    }  
                    break;  
                case "CountryId":  
                    var states = (from state in entities.States  
                                  where state.CountryId == value  
                                  select state).ToList();  
                    foreach (var state in states)  
                    {  
                        items.Add(new SelectListItem { Text = state.StateName, Value = state.StateId.ToString() });  
                    }  
                    break;  
                case "StateId":  
                    var cities = (from city in entities.Cities  
                                  where city.StateId == value  
                                  select city).ToList();  
                    foreach (var city in cities)  
                    {  
                        items.Add(new SelectListItem { Text = city.CityName, Value = city.CityId.ToString() });  
                    }  
                    break;  
            }  
            return Json(items);  
        }  
    }  
}  