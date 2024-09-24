<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Potchitos</title>
    <?php session_start()?>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <section id="introduction">
        <h1>Potchito's <br>Buns and Cookies.</h1> 
        <p>Homemade Specialty Pastries</p>
        <button id="introduction-button"> Learn More</button>
        <!-- <p id="p-quote">Where the finest pastries are made.</p> -->
    </section>
    <section id="customize-cakes">
        <div class="custom-container">
            <div id="cake-img-container">

            </div>
            <div id="cake-text-container">
                <h2>Need a Custom Cake?</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloribus enim adipisci doloremque, quasi officia fuga iste iusto necessitatibus quis expedita optio atque, est recusandae autem rem, hic porro ducimus eveniet?</p>
                <button>Check it Out</button>
            </div>

        </div>
    </section>
    <section id="pastries-cookies">
        <article id="buns-container">

        </article>
        <article id="cookies-container">

        </article>
    </section>
    <section id="booth">
        <h2>Need a booth for a party?</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita dolorem itaque quaerat corporis, aliquam aut. Cupiditate optio inventore eligendi, ratione dolores eum, blanditiis exercitationem fugit, ullam ex atque omnis voluptatem.
        Iusto nulla nostrum nam in eius molestiae ex tempore repellendus ipsam similique soluta, tenetur nisi. Iure aliquam sint dolorem alias cum consectetur officia sapiente ea assumenda odio! Iste, esse eligendi.
        Temporibus tenetur eaque sequi reiciendis voluptatibus voluptate provident, distinctio ullam rerum totam facere error ad quaerat nobis deleniti quia unde reprehenderit laudantium inventore velit animi omnis necessitatibus. Mollitia, officiis ducimus?
        Veritatis, culpa ullam esse, nesciunt dolor quasi laborum maxime, dolores delectus dolorum nihil facere repellat. Rem id laborum maiores laudantium delectus reiciendis tempora vitae, earum totam ducimus voluptatem blanditiis distinctio?</p>
        <button>
            Reserve Now
        </button>
    </section>
    <!-- <section id="supplies">
        
    </section> -->
    <?php include 'layout/footer.php'; ?>
</body>
<script src="../JS/header_loader.js"></script>
<script src="../JS/footer_loader.js"></script>
</html>