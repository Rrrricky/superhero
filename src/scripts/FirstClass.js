class FirstClass {
  parse() {



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




    class Click{
      constructor(){
        this.clicked()
        this.trigger()
      }
      clicked(){
        window.addEventListener(
          'click',
          ()=>{
            console.log('clicked function')
          }
        )
      }
      trigger(){
        window.addEventListener(
          'click',
          ()=>{
            console.log('trigger function')
          }
        )
      }
    }

    const click = new Click
  }
}