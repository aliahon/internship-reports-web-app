<?php
    require_once 'include/database.php';
    $id=$_GET['id'];
    $filiere=$_GET['filiere'];?>
<div class="col-md-3" >
    <label for="validationCustom10" class="form-label">Filière</label>
    <select class="form-select" id="validationCustom10" name="ID_filiere" required>
        <option value="<?php echo $id ;?>" selected><?php echo $filiere ;?></option>
        <?php
            $filieres = $pdo -> query('SELECT * FROM filieres')->fetchAll(PDO::FETCH_ASSOC);
            foreach($filieres as $filiere){
        ?>
        <option value="<?php echo $filiere['ID_filiere']; ?>"><?php echo $filiere['Nom_filiere']?></option>
        <?php }?>
    </select>
    <div class="invalid-feedback">
        Please select a valid Filiere.
    </div>
</div>