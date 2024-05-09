-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 07:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogrecetas`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `introduccion` varchar(1000) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`, `descripcion`, `introduccion`, `imagen`) VALUES
(1, 'Desayunos', 'Nuestro cuerpo necesita reponer sus niveles de azúcar para afrontar el día a día. Por ello, un buen desayuno es una de las bases de una buena alimentación y de una dieta equilibrada, ya que repone los niveles de glucosa, fuente de energía de nuestro organismo.', 'A continuación te presentamos opciones deliciosas de desayuno.', 'img/bannerDesayunos.png'),
(2, 'Platillos', 'El plato fuerte puede proporcionar una cantidad adecuada de proteínas, vitaminas y minerales esenciales para el cuerpo humano. También puede ayudar a mantener una sensación de saciedad y satisfacción después de una comida, lo que puede ayudar a prevenir el exceso de consumo de alimentos y a mantener un peso saludable. Además, dependiendo de los ingredientes utilizados, el plato fuerte puede ofrecer una amplia gama de sabores y texturas que pueden ser disfrutados por los comensales.', 'A continuación te presentamos opciones deliciosas de platillos para preparar.', 'img/bannerPlatillos.png'),
(3, 'Postres', 'Los postres pueden ser una deliciosa forma de satisfacer nuestro paladar y completar una comida. Además de su sabor dulce y a menudo reconfortante, algunos postres pueden ofrecer beneficios nutricionales como aportar vitaminas, minerales y fibra, dependiendo de los ingredientes utilizados. Además, los postres pueden ser una forma de compartir y disfrutar en compañía de familiares y amigos, lo que puede fomentar las relaciones interpersonales y el bienestar emocional.', 'A continuación te presentamos opciones deliciosas de postres.', 'img/bannerPostres.png'),
(4, 'Bebidas', 'Las bebidas dulces y refrescantes pueden ser una excelente fuente de hidratación en días calurosos o después de hacer ejercicio físico intenso. Además, pueden tener un sabor delicioso que muchas personas disfrutan, lo que puede aumentar el placer y la satisfacción al beberlas. Algunas bebidas dulces y refrescantes también contienen nutrientes importantes, como vitaminas y minerales, lo que puede proporcionar beneficios adicionales para la salud.', 'A continuación te presentamos opciones deliciosas de bebidas para preparar.', 'img/bannerBebidas.png'),
(5, 'Tips', 'Los tips de cocina son consejos prácticos y útiles que te ayudan a mejorar tus habilidades culinarias y hacer que tus comidas sean más deliciosas. Los tips de cocina también pueden ayudarte a ahorrar tiempo y esfuerzo en la cocina, y a ser más creativo en la preparación de tus comidas.', 'A continuación te presentamos prácticos tips de cocina.', 'img/bannerTips.png');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `idReceta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `comentario` varchar(1000) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `idReceta`, `idUsuario`, `comentario`, `fecha`) VALUES
(10, 31, 2, 'Delicioso', '2023-06-02'),
(11, 28, 2, 'Delicioso!', '2023-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `guardado`
--

CREATE TABLE `guardado` (
  `idUsuario` int(11) NOT NULL,
  `idReceta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardado`
--

INSERT INTO `guardado` (`idUsuario`, `idReceta`) VALUES
(2, 31),
(6, 28);

-- --------------------------------------------------------

--
-- Table structure for table `recetas`
--

CREATE TABLE `recetas` (
  `idReceta` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `nombreReceta` varchar(100) NOT NULL,
  `introduccion` varchar(1000) NOT NULL,
  `porciones` int(10) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `ingredientes` varchar(1000) NOT NULL,
  `procedimiento` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recetas`
--

INSERT INTO `recetas` (`idReceta`, `idCategoria`, `nombreReceta`, `introduccion`, `porciones`, `imagen`, `ingredientes`, `procedimiento`) VALUES
(28, 1, 'Hot cakes', 'Los hot cakes son una buena opción de desayuno ya que son ricos en carbohidratos y proporcionan energía para el día.\r\n        ', 4, '../img/hotcakes.jpg', '<li>2 Piezas de Huevo<li>\r\n                    <li>1 1/2 Taza CHEERIOS® AVENA Y MÁS GRANOS<li>\r\n                    <li>3/4 Taza Leche descremada<li>\r\n                    <li>1 Cucharada de Mantequilla<li>\r\n                    <li>1/2 Cucharadita de Polvo para hornear<li>\r\n                    <li>2 Cucharadas de Mantequilla<li>\r\n                    <li>2 Piezas de Fresa<li>\r\n                    <li>1/4 Taza de Mora azul<li> ', '<li><span><b>Licúa</b></span></li>\r\n                <li><b>1.</b>  Licúa los huevos junto con los CHEERIOS® AVENA Y MÁS GRANOS, la leche y la mantequilla fundida.\r\n                </li>\r\n                <li><span><b>Caliente</b></span></li>\r\n                <li><b>2.</b>  En una sartén caliente vierte la mezcla y cocina los hotcakes por ambos lados hasta que doren ligeramente.\r\n                </li>\r\n                <li><span><b>Sirve</b></span></li>\r\n                <li><b>3.</b>  Sirve los hotcakes, decora con las rebanas de fresa y las blueberries. Ofrece.\r\n                </li>'),
(29, 2, 'Pan de atún', ' El pan de atún es una deliciosa opción para una merienda o como parte de un almuerzo.\r\n            Es una opción saludable, rica en proteínas y baja en carbohidratos. Además, es fácil de preparar y puede ser una alternativa sabrosa para aquellos que desean reducir su consumo de carne roja.    \r\n        ', 8, '../img/atun.jpg', '<li>3 Latas de Atún enlatado en agua escurrido<li>\r\n                    <li>1/2 Cebolla morada picada finamente<li>\r\n                    <li>1 Taza de Aceitunas sin hueso picadas<li>\r\n                    <li>1 Cucharada de Salsa Tipo Inglesa <li>\r\n                    <li>1 Jitomate sin semillas y cortado en cuadritos<li>\r\n                    <li>3 Huevos<li>\r\n                    <li>2 Barras de Mantequilla a temperatura ambiente (90 g c/u)<li>\r\n                    <li>3/4 Taza de Azúcar<li>\r\n                    <li>1 1/2 Sobres de Levadura seca (11 g c/u)<li>\r\n                    <li>4 Tazas de Harina de trigo<li>\r\n                    <li>1/2 Cucharadita de Sal<li>\r\n                    <li>1 Lata de Leche Evaporada <li>\r\n                    <li>1 Cucharada de Mantequilla<li>\r\n                    <li>1/2 Cebolla fileteada<li>\r\n                    <li>3/4 Taza de Aceitunas<li>\r\n                    <li>3/4 Taza de Alcaparras enlatadas<li>\r\n                    <li>2 Piezas de Chile güero e', '<li><span><b>Prepara</b></span></li>\r\n                <li><b>1.</b>  Horno precalentado a 180 °C.</li>\r\n                <li><b>2.</b>  Para el relleno, mezcla el atún junto con la cebolla morada, las aceitunas, el jitomate y la Salsa Tipo Inglesa.\r\n                </li>\r\n                <li><span><b>Hornea</b></span></li>\r\n                <li><b>3.</b>  Para el pan, bate los huevos con la mantequilla, el azúcar y la levadura hasta integrar por completo; agrega poco a poco la harina, la sal y media lata de Leche Evaporada.\r\n                     Sobre una superficie enharinada, amasa la pasta hasta que esté integrada y golpéala firmemente para sacar el exceso de aire; déjala reposar una hora. Extiende la masa sobre una mesa \r\n                     enharinada y aplánala un poco con un rodillo; acomoda de manera uniforme el atún preparado y enrolla con cuidado. Pasa el pan a un molde de panqué, previamente engrasado y enharinado; \r\n                     deja reposar durante una hora o hasta '),
(30, 2, 'Bolitas de carne', 'Las bolitas de carne son una opción deliciosa para los amantes de la carne molida.\r\n        ', 4, '../img/carne.jpg', '<li>500 Gramos Carne de res de carne molida<li>\r\n                    <li>1/2 Taza Pan molido<li>\r\n                    <li>1 Cubo *Consomé de pollo en polvo<li>\r\n                    <li>1 Pieza Huevo<li>\r\n                    <li>1/2 Cucharada Cebolla en polvo<li>\r\n                    <li>1/4 Cucharada Ajo en polvo<li>\r\n                    <li>1000 Miligramos Agua<li>\r\n                    <li>300 Gramos de Mermelada de chabacano<li>\r\n                    <li>1/4 Taza Salsa Tipo Inglesa<li>', '<li><span><b>Cocer</b></span></li>\r\n                <li><b>1.</b>  Mezcla la carne con el pan molido, el consomé de pollo, el huevo y la cebolla y ajo en polvo . Forma 50 bolitas, calienta el agua, agrega las bolitas y déjalas hervir hasta que se cuezan (15 minutos aproximadamente).\r\n                </li>\r\n                <li><span><b>Preparar</b></span></li>\r\n                <li><b>2.</b>  Para la salsa calienta la mermelada con la Salsa Tipo Inglesa CROSSE & BLACKWELL® durante 3 minutos o hasta que espese un poco.\r\n                </li>\r\n                <li><span><b>Servir</b></span></li>\r\n                <li><b>3.</b>  Sirve las bolitas de carne bañadas con la salsa.\r\n                </li>'),
(31, 2, 'Hamburguesa', 'Las hamburguesas pueden ser una excelente opción para una comida rápida y satisfactoria. Además, se pueden personalizar con una variedad de ingredientes para satisfacer diferentes gustos y preferencias alimentarias.\r\n        ', 4, '../img/hamburguesa.jpg', '<li>450 Gramos de Carne molida de res<li>\r\n                    <li>1/2 Taza de Quinoa cocida<li>\r\n                    <li>1/4 Cebolla picada finamente<li>\r\n                    <li>1 Huevo<li>\r\n                    <li>1/4 Taza de Pan molido<li>\r\n                    <li>2 Cucharadas de Jugo MAGGi reducido en sodio<li>\r\n                    <li>2 Cucharadas de Salsa Tipo Inglesa <li>\r\n                    <li>2 Dientes de Ajo picados finamente<li>\r\n                    <li>1/2 Cucharadita de Sal con cebolla en polvo<li>\r\n                    <li>6 Rebanadas de Queso cheddar<li>\r\n                    <li>6 Cucharadas de Mayonesa<li>\r\n                    <li>6 Bollos para hamburguesa calientes<li>\r\n                    <li>6 Cucharadas de Cátsup<li>\r\n                    <li>6 Cucharadas de Mostaza Dijon<li>\r\n                    <li>1 Taza de Espinacas desinfectadas<li>\r\n                    <li>1 Aguacate cortado en rebanadas<li>\r\n                    <li>1 Jitomate cortado en rebanadas<li>\r\n      ', '<li><span><b>Mezcla</b></span></li>\r\n                <li><b>1.</b>  Mezcla la carne con la quínoa, ¼ pieza de cebolla picada, el huevo, el pan molido, el Jugo MAGGI, la Salsa Tipo Inglesa, el ajo y la sal con cebolla hasta integrar por completo. Divide en 6 partes iguales y con tus manos forma las hamburguesas de ½ centímetro de grosor.\r\n                </li>\r\n                <li><span><b>Cocina</b></span></li>\r\n                <li><b>2.</b>  Cubre con papel encerado las parrillas de la Súper Freidora de Aire, coloca las hamburguesas y cocina a 180 °C por 10 minutos, intercambia las parrillas y programa 5 minutos más la cocción de la carne. Nuevamente intercambia las parrillas y cocina por 3 minutos más. Agrega el queso y cocina por 2 minutos.\r\n                </li>\r\n                <li><span><b>Sirve</b></span></li>\r\n                <li><b>3.</b>  Unta un poco de mayonesa sobre los bollos, añade la carne, la cátsup, la mostaza, las espinacas, el aguacate, el jitomate y la cebolla mora'),
(32, 1, 'Pasta', ' La pasta a la crema es una preparación muy versátil y fácil de hacer. Además, la crema le da una textura suave y cremosa que la hace muy agradable al paladar. \r\n     ', 4, '../img/pasta.jpg', '<li>2 Cucharadas de Mantequilla<li>\r\n                    <li>1 Paquete de Pasta tipo espagueti cocido y escurrido (250 g)<li>\r\n                    <li>2 Jitomates picados<li>\r\n                    <li>1 Cucharadita de Sal con ajo en polvo<li>\r\n                    <li>1 Cucharadita Consomé de pollo en polvo<li>\r\n                    <li>1 Lata de Leche Evaporada (1 1/2 tazas)<li>\r\n                    <li>1/2 Paquete de Queso crema (95 g)<li> ', '<li><span><b>Fríe</b></span></li>\r\n                <li><b>1.</b>  Coloca la mantequilla en una sartén y fríe la pasta, mueve constantemente por 2 minutos, para evitar que se pegue.\r\n                </li>\r\n                <li><span><b>Licúa</b></span></li>\r\n                <li><b>2.</b>  Licúa la Leche Evaporada, los jitomates, la sal con cebolla en polvo, el consomé de pollo y el queso crema.\r\n                \r\n                </li>\r\n                <li><span><b>Sirve</b></span></li>\r\n                <li><b>3.</b>  Vierte a la pasta al al salsa y cocina por 10 minutos más. Ofrece caliente.\r\n                </li>'),
(33, 1, 'Tiras de pollo', 'Las tiras de pollo con salsa de miel y ajo son una opción deliciosa y fácil de preparar \r\n            para una comida o cena. La combinación de la dulzura de la miel y el sabor fuerte del ajo crean una deliciosa combinación de sabores.\r\n      ', 6, '../img/pollo.jpg', '<li>2 Tazas de Pan molido<li>\r\n                    <li>1 Taza de Avena molida<li>\r\n                    <li>1 1/2 Cucharadas de Sal con cebolla en polvo<li>\r\n                    <li>700 Gramos de Pollo en fajitas<li>\r\n                    <li>1 Taza de Harina de trigo pasada por un colador<li>\r\n                    <li>4 Huevos ligeramente batidos<li>\r\n                    <li>Aceite en aerosol<li>\r\n                    <li>3/4 Taza de Miel de abeja<li>\r\n                    <li>1/4 Taza de Vinagre de arroz<li>\r\n                    <li>4 Cucharadas de Salsa de Soya<li>\r\n                    <li>1 Cucharada de Aceite de ajonjolí<li>\r\n                    <li>2 Cucharaditas de Ajo en polvo<li>\r\n                    <li>2 Cucharadas de Fécula de maíz disuelta en ¼ taza de agua<li>', '<li><span><b>Mezcla</b></span></li>\r\n                <li><b>1.</b>  Mezcla el pan molido, la avena y la sal con cebolla. Cubre las fajitas de pollo con la harina, pásalas por el huevo y después por la mezcla del pan molido; agrega algunos disparos de aceite sobre las tiras de pollo.\r\n                </li>\r\n                <li><span><b>Cocina</b></span></li>\r\n                <li><b>2.</b>  Coloca algunas en las parrillas de la Súper Freidora de Aire y fríe con aire a 170 °C por 10 minutos, intercambia las parrillas y fríe por 5 minutos. Nuevamente intercambiar las parrillas y cocina por 5 minutos más.\r\n                </li>\r\n                <li><span><b>Sirve</b></span></li>\r\n                <li><b>3.</b>  Para la salsa de miel y ajo, calienta la miel con el vinagre de arroz, la Salsa de Soya MAGGI®, el aceite de ajonjolí y el ajo hasta que hierva. Agrega la fécula de maíz disuelta y cocina hasta que espese ligeramente. Sirve las tiras de pollo con la salsa y ofrece.\r\n                </'),
(34, 1, 'Quesadillas', 'Las quesadillas pueden ser una opción \r\n            deliciosa y satisfactoria para aquellos que disfrutan de la comida mexicana.\r\n      ', 4, '../img/quesadillas.jpg', '<li>1 Taza Aceite de maíz</li>\r\n                <li>6 Piezas Chile poblano</li>\r\n                <li>1 Taza Granos de elote amarillo</li>\r\n                <li>1 Cucharada Sal con cebolla en polvo</li>\r\n                <li>1 Lata Media Crema</li>\r\n                <li>1 Paquete Queso crema</li>\r\n                <li>500 Gramos Masa para tortillas de maíz</li>\r\n                <li>1 Cucharada Aceite de maíz</li>\r\n                <li>1/2 Pieza Cebolla fileteada</li>', '<li><span><b>Cocinar</b></span></li>\r\n                <li><b>1.</b>  Calienta el aceite y fríe la cebolla, agrega las rajas y los granos de elote, cocina por 8 minutos. \r\n                    Licúa la Media Crema con la sal con cebolla en polvo, el queso crema y vierte a la preparación anterior, \r\n                    mezcla y cocina por 5 minutos o hasta que espese ligeramente.\r\n                </li>\r\n                <li><span><b>Mezclar</b></span></li>\r\n                <li><b>2.</b>  Mezcla la masa con la sal, forma bolitas, aplana y rellena con un poco de rajas con crema, cierra y \r\n                    presiona las orillas con un tenedor para evitar que se abran.\r\n                </li>\r\n                <li><span><b>Freír</b></span></li>\r\n                <li><b>3.</b>  Fríe las quesadillas en el aceite caliente hasta que estén doradas, retira del fuego y utiliza \r\n                    servilletas para retirar el exceso de aceite. Ofrece acompañado de una salsa roja.\r\n                </l');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idRol`, `descripcion`) VALUES
(1, 'comentarista - lector'),
(2, 'administrador');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `imagenUsuario` varchar(100) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `correo`, `contrasena`, `imagenUsuario`, `idRol`) VALUES
(2, 'Andrea Márquez', 'andreaisabl@hotmail.com', 'password', '../img/b.jpg', 2),
(6, 'Usuario', 'usuario@gmail.com', 'usuario123', '../img/user.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idReceta` (`idReceta`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `guardado`
--
ALTER TABLE `guardado`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idReceta` (`idReceta`);

--
-- Indexes for table `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`idReceta`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `recetas`
--
ALTER TABLE `recetas`
  MODIFY `idReceta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idReceta`) REFERENCES `recetas` (`idReceta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guardado`
--
ALTER TABLE `guardado`
  ADD CONSTRAINT `guardado_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `guardado_ibfk_2` FOREIGN KEY (`idReceta`) REFERENCES `recetas` (`idReceta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
