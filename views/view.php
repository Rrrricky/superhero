<?
class View{

  // Name of the file associates to the view
  private $file;
  // Title of the view
  private $title;


  // Create and display the view
  public function generate($data) {
    // A specific container of the view
    $container = $this->generate_file($this->file, $data);
    // Creation of the file
    $view = $this->generate_file('Vue/gabarit.php', ['title' => $this->title, 'container' => $container]);
    echo $view;
  }

  // Create a view file and return the result
  private function generateFile($file, $data) {
    if (file_exists($file)) {
      // Put elements from the $data array inside the view
      extract($data);
      ob_start();
      require $file;
      return ob_get_clean();
    }
    else {
      throw new Exception("File '$file' unfindable");
    }
  }
}