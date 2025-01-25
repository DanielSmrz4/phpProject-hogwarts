<form action="" method="POST">
    <input  type="text"
            name="first_name"
            placeholder="First name"
            value="<?=htmlspecialchars($first_name)?>"
    >
    <input  type="text"
            name="second_name"
            placeholder="Second name"
            value="<?=htmlspecialchars($second_name)?>"
    >
    <input  type="number"
            name="age"¨
            placeholder="Age"
            min="6"
            value="<?=htmlspecialchars($age)?>"
    >
    <textarea name="life"
                placeholder="Student records"
                ><?=htmlspecialchars($life)?></textarea>
    <input  type="text"
            name="colledge"
            placeholder="Colledge"
            value="<?=htmlspecialchars($colledge)?>"
    >
    <input type="submit" value="Save">
</form>