<?php
    echo<<<_END
        <form action="pintar.php" method="post">
        <label for="dim">Dimension Matriz</label>
        <br>
        <input type="number" name="dim" required>
        <input type="submit" value="Pintar">
        </form>
    _END;
?>