<?php
class habitat
{
    public $id;
    public $nom;
    public $typeclimat;
    public $description;
    public $zonezoo;
    public function __construct($id, $nom, $typeclimat, $description, $zonezoo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->typeclimat = $typeclimat;
        $this->description = $description;
        $this->zonezoo = $zonezoo;
    }

    public static function gethabitat($conn, $id)
    {
        $stmt = $conn->prepare("select * from habitats where id = {$id}");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $habitat = new habitat($row->id, $row->nom, $row->typeclimat, $row->description, $row->zonezoo);

        return $habitat;
    }
}


class Animal
{
    public $id;
    public $nom;
    public $esepece;
    public $alimentation;
    public $image;
    public $paysOrigine;
    public $descriptionCourte;
    public $idHabitat;

    public function __construct($id, $nom, $esepece, $alimentation, $image, $paysOrigine, $descriptionCourte, $idHabitat)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->esepece = $esepece;
        $this->alimentation = $alimentation;
        $this->image = $image;
        $this->paysOrigine = $paysOrigine;
        $this->descriptionCourte = $descriptionCourte;
        $this->idHabitat = $idHabitat;
    }

    public function __toString()
    {
        return "id: $this->id, nom: $this->nom, espece: $this->esepece, alimentation: $this->alimentation, pays d'origine: $this->paysOrigine, description: $this->descriptionCourte <br>";
    }


    public static function getAll($conn)
    {
        $stmt = $conn->prepare('select * from animaux');
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $animal = new Animal($row->id, $row->nom, $row->espece, $row->alimentation, $row->image, $row->paysorigine, $row->descriptioncourte, $row->id_habitat);
            $habitat = habitat::gethabitat($conn, $animal->idHabitat);
            $Deux[] = ["animal"=>$animal,"habitat"=> $habitat];

        }
        

        return $Deux;
    }
}
$host = "localhost";
$db = "assad";
$user = 'root';
$pass = "ME551234";
$port = 3307;

$conn = new PDO("mysql:host={$host};port={$port};dbname={$db};", $user, $pass);

$animals = Animal::getAll($conn);
// print_r($animals);


foreach($animals as $animal){
    if($animal['habitat']->id == $animal['animal']->idHabitat){
        echo "nom: ". $animal["animal"]->nom."<br> habitat: ".$animal["habitat"]->nom."<br><br>";
    }
}



// foreach($animals as $animal){
//     echo $animal;
// }

// function findByIndex($arr, $index)
// {
//     foreach ($arr as $item) {
//         if ($item->id == $index) {
//             return $item;
//         }
//     }
// }

// $b = findByIndex($animals, 2);

// print_r($b);
