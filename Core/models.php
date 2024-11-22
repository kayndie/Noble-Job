<?php  

function insertSurgeon($pdo, $Surgeon_name, $experience_level, $Specialization) {
    $sql = "INSERT INTO Surgeon (Surgeon_name, experience_level, Specialization) VALUES(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_name, $experience_level, $Specialization]);

    if ($executeQuery) {
        return true;
    } else {
        return false;
    }
}

function deleteSurgeon($pdo, $Surgeon_id) {
    try {
        $sql = "DELETE FROM Surgeon WHERE Surgeon_id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$Surgeon_id]);
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function updateSurgeon($pdo, $Surgeon_name, $experience_level, $Specialization, $Surgeon_id) {
    $sql = "UPDATE Surgeon SET Surgeon_name = ?, experience_level = ?, Specialization = ? WHERE Surgeon_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_name, $experience_level, $Specialization, $Surgeon_id]);

    if ($executeQuery) {
        return true;
    }
}

function getAllSurgeon($pdo) {
    $sql = "SELECT * FROM Surgeon";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getSurgeonByID($pdo, $Surgeon_id) {
    $sql = "SELECT * FROM Surgeon WHERE Surgeon_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$Surgeon_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function searchSurgeon($pdo, $searchTerm) {
    $sql = "SELECT * FROM Surgeon WHERE Surgeon_name LIKE :search OR Specialization LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%$searchTerm%"]);
    return $stmt->fetchAll();
}

?>
