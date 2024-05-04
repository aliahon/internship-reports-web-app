<div class="col-md-3 ">
    <label for="validationCustom06" class="form-label">Filière</label>
    <select class="form-select" id="validationCustom06" name="ID_filiere" required>
        <?php
            require_once 'include/database.php';
            $filieres = $pdo -> query('SELECT * FROM filieres')->fetchAll(PDO::FETCH_ASSOC);
            foreach($filieres as $filiere){
        ?>
        <option value="<?php echo $filiere['ID_filiere'] ?>"><?php echo $filiere['Nom_filiere']?></option>
        <?php }?>
    </select>
    <div class="invalid-feedback">
        Please select a valid Filiere.
    </div>
</div>
<div class="col-md-3 ">
    <label for="validationCustom07" class="form-label">Niveau</label>
    <select class="form-select" id="validationCustom07" name="ID_niveau" required>
        <option value="1">1ére année cycle d'ingénieur</option>
        <option value="2">2éme année cycle d'ingénieur</option>
        <option value="3">3éme année cycle d'ingénieur</option>
    </select>
    <div class="invalid-feedback">
        Please select a valid Niveau.
    </div>
</div>