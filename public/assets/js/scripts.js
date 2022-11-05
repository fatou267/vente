window.onload = () => {
	let menus = document.querySelectorAll(".dropdown-sousmenu a.dropdown-toggle")
	for ( let menu of menus)
	{
		menu.addEventListener("click", function(e){
		    e.stopPropagation()
			e.preventDefault()

			// masquer les urls des sous menus 
			let sousmenus = document.querySelectorAll(".menu .dropdown-menu")
			for(let sousmenu of sousmenus)
			{
			 	sousmenu.style.display = "none"
			}

			this.nextElementSibling.style.display = "initial"

		})
	
	}	
}