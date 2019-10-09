<?php 
class Paiement{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Paiement"; 
  
    // object properties 
    public $idPaiement; 
    public $signaturePaiement; 
    public $permisConstruirePaiement; 
	public $OuvertureChantierPaiement;
	public $achevementFondationPaiement; 
	public $achevementMurPaiement;
	public $misHorsDeauPaiement; 
	public $achevementTravauxPaiement,
	public $remiseClePaiement;
	public $statutPaiement;
	public $dateDernierPaiement;
	public $idCommande;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
		
    public function read() {
      // Create query
      $query = 'SELECT
			idPaiement,
			signaturePaiement,
			permisConstruirePaiement, 
			OuvertureChantierPaiement,
			achevementFondationPaiement, 
			achevementMurPaiement,
			misHorsDeauPaiement, 
			achevementTravauxPaiement,
			remiseClePaiement,
			statutPaiement,
			dateDernierPaiement,
			idCommande
		FROM 
        ' . $this->table_name;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  public function read_one(){
    // Create query
    $query = 'SELECT
			idPaiement,
			signaturePaiement,
			permisConstruirePaiement, 
			OuvertureChantierPaiement,
			achevementFondationPaiement, 
			achevementMurPaiement,
			misHorsDeauPaiement, 
			achevementTravauxPaiement,
			remiseClePaiement,
			statutPaiement,
			dateDernierPaiement,
			idCommande
        FROM
          ' . $this->table_name . '
      WHERE idPaiement = :paiementId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':paiementId', $this->idPaiement);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idPaiement = $row['idPaiement'];
      $this->signaturePaiement = $row['signaturePaiement'];
	  $this->permisConstruirePaiement = $row['permisConstruirePaiement'];
      $this->OuvertureChantierPaiement = $row['OuvertureChantierPaiement'];
	  $this->achevementFondationPaiement = $row['achevementFondationPaiement'];
	  $this->achevementMurPaiement = $row['achevementMurPaiement'];
	  $this->misHorsDeauPaiement = $row['misHorsDeauPaiement'];
      $this->achevementTravauxPaiement = $row['achevementTravauxPaiement'];
	  $this->remiseClePaiement = $row['remiseClePaiement'];
	  $this->statutPaiement = $row['statutPaiement'];
	  $this->dateDernierPaiement = $row['dateDernierPaiement'];
      $this->idCommande = $row['idCommande'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		signaturePaiement= :paiementSignature,
		permisConstruirePaiement= :paiementPermisConstruire, 
		OuvertureChantierPaiement= :paiementOuvertureChantier,
		achevementFondationPaiement= :paiementAchevementFondation, 
		achevementMurPaiement= :paiementAchevementMur,
		misHorsDeauPaiement= :paiementMisHorsDeau, 
		achevementTravauxPaiement= :paiementAchevementTravaux,
		remiseClePaiement= :paiementRemiseCle,
		statutPaiement= :paiementStatut,
		dateDernierPaiement= :paiementDateDernier,
		idCommande= :commandeId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->signaturePaiement = htmlspecialchars(strip_tags($this->signaturePaiement));
  $this->permisConstruirePaiement = htmlspecialchars(strip_tags($this->permisConstruirePaiement));
  $this->OuvertureChantierPaiement = htmlspecialchars(strip_tags($this->OuvertureChantierPaiement));
  $this->achevementFondationPaiement = htmlspecialchars(strip_tags($this->achevementFondationPaiement));
  $this->achevementMurPaiement = htmlspecialchars(strip_tags($this->achevementMurPaiement));
  $this->misHorsDeauPaiement = htmlspecialchars(strip_tags($this->misHorsDeauPaiement));
  $this->achevementTravauxPaiement = htmlspecialchars(strip_tags($this->achevementTravauxPaiement));
  $this->remiseClePaiement = htmlspecialchars(strip_tags($this->remiseClePaiement));
  $this->statutPaiement = htmlspecialchars(strip_tags($this->statutPaiement));
  $this->dateDernierPaiement = htmlspecialchars(strip_tags($this->dateDernierPaiement));
  $this->idCommande = htmlspecialchars(strip_tags($this->idCommande));
  
  // Bind data
  $stmt-> bindParam(':paiementSignature', $this->signaturePaiement);
  $stmt-> bindParam(':paiementPermisConstruire', $this->permisConstruirePaiement);
  $stmt-> bindParam(':paiementOuvertureChantier', $this->OuvertureChantierPaiement);
  $stmt-> bindParam(':paiementAchevementFondation', $this->achevementFondationPaiement);
  $stmt-> bindParam(':paiementAchevementMur', $this->achevementMurPaiement);
  $stmt-> bindParam(':paiementMisHorsDeau', $this->misHorsDeauPaiement);
  $stmt-> bindParam(':paiementAchevementTravaux', $this->achevementTravauxPaiement);
  $stmt-> bindParam(':paiementRemiseCle', $this->remiseClePaiement);
  $stmt-> bindParam(':paiementStatut', $this->statutPaiement);
  $stmt-> bindParam(':paiementDateDernier', $this->dateDernierPaiement);
  $stmt-> bindParam(':commandeId', $this->idCommande);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table_name . '
    SET
        signaturePaiement= :paiementSignature,
		permisConstruirePaiement= :paiementPermisConstruire, 
		OuvertureChantierPaiement= :paiementOuvertureChantier,
		achevementFondationPaiement= :paiementAchevementFondation, 
		achevementMurPaiement= :paiementAchevementMur,
		misHorsDeauPaiement= :paiementMisHorsDeau, 
		achevementTravauxPaiement= :paiementAchevementTravaux,
		remiseClePaiement= :paiementRemiseCle,
		statutPaiement= :paiementStatut,
		dateDernierPaiement= :paiementDateDernier,
		idCommande= :commandeId 
      WHERE idPaiement = :paiementId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

    // Clean data
  $this->signaturePaiement = htmlspecialchars(strip_tags($this->signaturePaiement));
  $this->permisConstruirePaiement = htmlspecialchars(strip_tags($this->permisConstruirePaiement));
  $this->OuvertureChantierPaiement = htmlspecialchars(strip_tags($this->OuvertureChantierPaiement));
  $this->achevementFondationPaiement = htmlspecialchars(strip_tags($this->achevementFondationPaiement));
  $this->achevementMurPaiement = htmlspecialchars(strip_tags($this->achevementMurPaiement));
  $this->misHorsDeauPaiement = htmlspecialchars(strip_tags($this->misHorsDeauPaiement));
  $this->achevementTravauxPaiement = htmlspecialchars(strip_tags($this->achevementTravauxPaiement));
  $this->remiseClePaiement = htmlspecialchars(strip_tags($this->remiseClePaiement));
  $this->statutPaiement = htmlspecialchars(strip_tags($this->statutPaiement));
  $this->dateDernierPaiement = htmlspecialchars(strip_tags($this->dateDernierPaiement));
  $this->idCommande = htmlspecialchars(strip_tags($this->idCommande));
  $this->idPaiement = htmlspecialchars(strip_tags($this->idPaiement));
	
  // Bind data
  $stmt-> bindParam(':paiementSignature', $this->signaturePaiement);
  $stmt-> bindParam(':paiementPermisConstruire', $this->permisConstruirePaiement);
  $stmt-> bindParam(':paiementOuvertureChantier', $this->OuvertureChantierPaiement);
  $stmt-> bindParam(':paiementAchevementFondation', $this->achevementFondationPaiement);
  $stmt-> bindParam(':paiementAchevementMur', $this->achevementMurPaiement);
  $stmt-> bindParam(':paiementMisHorsDeau', $this->misHorsDeauPaiement);
  $stmt-> bindParam(':paiementAchevementTravaux', $this->achevementTravauxPaiement);
  $stmt-> bindParam(':paiementRemiseCle', $this->remiseClePaiement);
  $stmt-> bindParam(':paiementStatut', $this->statutPaiement);
  $stmt-> bindParam(':paiementDateDernier', $this->dateDernierPaiement);
  $stmt-> bindParam(':commandeId', $this->idCommande);
  $stmt-> bindParam(':paiementId', $this->idPaiement);
 
  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete 
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idPaiement = :paiementId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idPaiement = htmlspecialchars(strip_tags($this->idPaiement));

    // Bind Data
    $stmt-> bindParam(':paiementId', $this->idPaiement);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}