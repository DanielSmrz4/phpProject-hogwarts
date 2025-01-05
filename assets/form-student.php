<form action="" method="POST">
    <input  type="text"
            name="first_name"
            placeholder="Křestní jméno"
            value="<?=htmlspecialchars($first_name)?>"
    >
    <input  type="text"
            name="second_name"
            placeholder="Příjmení"
            value="<?=htmlspecialchars($second_name)?>"
    >
    <input  type="number"
            name="age"¨
            placeholder="Age"
            min="6"
            value="<?=htmlspecialchars($age)?>"
    >
    <textarea name="life"
                placeholder="Studijní přehled"
                ><?=htmlspecialchars($life)?></textarea>
    <input  type="text"
            name="colledge"
            placeholder="Kolej"
            value="<?=htmlspecialchars($colledge)?>"
    >
    <input type="submit" value="Uložit">
</form>