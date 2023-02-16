<?php  
$lang = $_SESSION["lang"];
$traduction = traduction();
?>

    </main>
    <footer>
        <div>Quentin Doniczka - 2022</div>
        <div>
            <?php if($lang == "en") { ?>
                <button data-lang="fr" title='<?php echo $traduction[$lang]["lang"]["change_fr"] ?>'><img src="/assets/img/fr.png"></button>
            <?php } else { ?>
                <button data-lang="en" title='<?php echo $traduction[$lang]["lang"]["change_en"] ?>'><img src="/assets/img/en.png"></button>
            <?php } ?>
        </div>
    </footer>

    <script src="/assets/js/script.js"></script>
</body>
</html>