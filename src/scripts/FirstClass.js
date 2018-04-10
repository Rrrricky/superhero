class FirstClass {
  parse() {

    class Header{
      
      constructor(){
        this.display()
      }

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
    // class Bloc{
    //   constructor(width, height, $title){
    //     this.width= width
    //     this.height= height
    //     this.$title= document.querySelector("h1")
    //   }
    //   area(){
    //     return this.width*this.height
    //   } 
    //   click(){
    //     this.$title.addEventListener(
    //       "click",
    //       ()=>{
    //         alert("works")
    //       }
    //     )
    //   }
    // }

    // const block1 = new Bloc(100, 2)
    // console.log(block1.area())
    // block1.click()