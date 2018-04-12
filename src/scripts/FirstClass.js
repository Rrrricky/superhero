class FirstClass {
  parse() {

    class Header{

      constructor(){
        this.display()
      }

      // Display sub-header on hover on 'Hello'
      display(){
        if(document.querySelector(".js-app-header-nav__profil")){ // If the element exists
        const $profil = document.querySelector(".js-app-header-nav__profil")
        const $displayElement = document.querySelector(".js-app-header-nav__profil__displayer--hidden")

        $profil.addEventListener(
          "mouseover",
          ()=>{
            $displayElement.style.display="flex"
          }
        )
        $profil.addEventListener(
          "mouseout",
          ()=>{
            $displayElement.style.display="none"
          }
        )
      }
    }
  }
  const header = new Header()
  }
}