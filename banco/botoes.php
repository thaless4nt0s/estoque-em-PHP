<?php
    function buttons($id){ 
        echo '<a href="../banco/updateUser.php?user='.$id.'" class="button is-small" alt="atualizar"> <i class="fas fa-pen"></i></a>';
        echo '<a href="../banco/deleteUser.php?user='.$id.'" class="button is-small" alt="atualizar"> <i class="fas fa-trash-alt"></i></a>';
        echo '<a href="../banco/seeUser.php?user='.$id.'"class="button is-small" alt="atualizar"> <i class="fas fa-eye"></i></a>';
    }

    function buttonsProd($id){ 
        echo '<a href="../banco/updateProd.php?user='.$id.'" class="button is-small" alt="atualizar"> <i class="fas fa-pen"></i></a>';
        echo '<a href="../banco/deleteProd.php?user='.$id.'" class="button is-small" alt="atualizar"> <i class="fas fa-trash-alt"></i></a>';
        echo '<a href="../banco/seeProd.php?user='.$id.'"class="button is-small" alt="atualizar"> <i class="fas fa-eye"></i></a>';
    }
?>