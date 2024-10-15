-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2024 a las 17:24:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jardin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `ID` int(3) NOT NULL,
  `Dia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`ID`, `Dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(3) NOT NULL,
  `Dia` varchar(70) NOT NULL,
  `Inicio` varchar(70) NOT NULL,
  `Fin` varchar(70) NOT NULL,
  `Sala` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `Dia`, `Inicio`, `Fin`, `Sala`) VALUES
(8, '3', '9:30', '10:30', 2),
(9, '5', '15:00', '16:00', 4),
(11, '2', '15:00', '16:00', 3),
(12, '1', '12:00', '13:00', 8),
(13, '1', '12:00', '13:00', 11),
(26, '4', '12:30', '13:30', 6),
(27, '3', '12:30', '13:30', 3),
(28, '5', '12:30', '16:00', 4),
(29, '3', '15:00', '16:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(3) NOT NULL,
  `DNI` int(8) NOT NULL,
  `CONTRASEÑA` varchar(255) NOT NULL,
  `ROL` varchar(20) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `DNI`, `CONTRASEÑA`, `ROL`, `NOMBRE`) VALUES
(18, 46946867, '$2y$10$dtvsjVk8pL9O0aiquML5Zue/MK0YKxeXS4yJqnIsFskjfBsNmacxm', '2', 'Martina Vila'),
(28, 12345678, '$2y$10$5tmbrGxvo4RokbquwBh7Wul8ln561PDMyXUTswuKLsOwfzmgVmpvW', '4', 'Abril Leaniz'),
(30, 49350093, '$2y$10$GcoRtWZ5TJ04IyeM84tanOLWiPgemien.B6b3zg2FWbpIRn4dC8ra', '2', 'Sala Violeta'),
(31, 1111, '$2y$10$QgFVZZyNwGxn7uDkpR1ypeODCCz9XgiTTZ9FMbCbeNbr8GOYhVyYy', '3', 'Sala Violeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `ID` int(3) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Descripcion` text NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `ID_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`ID`, `Nombre`, `Descripcion`, `Imagen`, `ID_usuario`) VALUES
(2, 'Nueva noticia', 'Lalala', 'uploads/IMG_20240315_222243_675.jpg', 18),
(3, 'Nueva noticia 2 ', 'aloe veera', 'uploads/WhatsApp Image 2024-08-22 at 20.37.44.jpeg', 18),
(5, 'Nueva Noticia Willy', 'vavavavavavav', 'uploads/jardines-de-infantes.jpg', 18),
(7, 'Sala Violeta2', 'aaaaa2', 'uploads/_9687d469-9b07-42e0-a2c2-db60b69f705a.jpg', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `ID` int(3) NOT NULL,
  `Salas` int(3) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Turno` int(3) NOT NULL,
  `id_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`ID`, `Salas`, `Nombre`, `Descripcion`, `Imagen`, `Turno`, `id_usuario`) VALUES
(6, 6, 'Aprendiendo sobre musicaaaaaaaaa', 'En este proyecto, que realizamos junto a los niños, les enseñamos sobre una de la artes mas importantes: La musica.', 'uploads/IMG_20240315_222243_619.jpg', 1, 18),
(7, 2, 'Transito seguro!', 'Seguimos aprendiendo juntos sobre lo que corresponde y lo que no a la hora de conducir.', 'uploads/IMG_20240315_222243_619.jpg', 1, 18),
(9, 4, 'Juntos jugandos!', 'Look at this!', 'uploads/IMG_20240315_222243_675.jpg', 1, 18),
(10, 5, 'Another one', 'aaaa', 'uploads/IMG_20240315_222243_747.jpg', 2, 18),
(11, 3, 'Sala naranja', 'Aaaaaaaa', 'uploads/IMG_20240312_183634_038.jpg', 2, 18),
(12, 4, 'Sala Turquesa', 'Aaaaaa', 'uploads/IMG_20240315_222243_723.jpg', 2, 18),
(13, 5, 'Sala Verde', 'Aaaaaa', 'uploads/IMG_20240315_222243_747.jpg', 1, 18),
(14, 6, 'Sala Roja', 'Aaaaaaaa', 'uploads/IMG_20231219_104728_781.jpg', 1, 18),
(23, 1, 'Sala VIoleta', 'ALLALAA', 'uploads/SPORTS.jpg', 1, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones`
--

CREATE TABLE `reacciones` (
  `ID` int(3) NOT NULL,
  `Publicacion_ID` int(3) NOT NULL,
  `Usuario_IP` varchar(45) NOT NULL,
  `Reaccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reacciones`
--

INSERT INTO `reacciones` (`ID`, `Publicacion_ID`, `Usuario_IP`, `Reaccion`) VALUES
(1, 10, '::1', 'risa'),
(2, 9, '::1', 'me_gusta'),
(3, 7, '::1', 'risa'),
(4, 15, '::1', 'risa'),
(5, 11, '::1', 'risa'),
(6, 12, '::1', 'risa'),
(7, 17, '::1', 'risa'),
(8, 14, '::1', 'me_gusta'),
(9, 18, '::1', 'risa'),
(10, 13, '::1', 'risa'),
(11, 16, '::1', 'risa'),
(12, 6, '::1', 'risa'),
(13, 20, '::1', 'risa'),
(14, 21, '::1', 'me_gusta'),
(15, 22, '::1', 'risa'),
(16, 23, '::1', 'risa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID` int(3) NOT NULL,
  `ROL` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID`, `ROL`) VALUES
(1, 'Maestro'),
(2, 'Directivo'),
(3, 'EOE'),
(4, 'Secretaria'),
(5, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `ID` int(3) NOT NULL,
  `Salas` varchar(15) NOT NULL,
  `Color` varchar(10) NOT NULL,
  `texto` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `hover` varchar(255) DEFAULT NULL,
  `texto2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`ID`, `Salas`, `Color`, `texto`, `imagen`, `hover`, `texto2`) VALUES
(1, 'Sala Violeta', '#a84cc2', 'La Sala Violeta es un espacio diseñado para la serenidad y la creatividad. Las paredes están pintadas en tonos suaves de violeta, creando una atmósfera acogedora y tranquila. Con cómodos asientos dispuestos en un estilo íntimo y minimalista, esta sala invita a la reflexión y a la conexión personal. Es el lugar perfecto para reuniones pequeñas, talleres creativos, o momentos de relajación. La iluminación tenue y cálida acentúa la sensación de calma, mientras que los detalles decorativos en plata y blanco añaden un toque de elegancia. La Sala Violeta es ideal para quienes buscan un ambiente pacífico y elegante para sus actividades.\r\n\r\n', 'uploads/violet.png', '#7d368c', 'La Sala Violeta también está equipada con tecnología moderna para facilitar presentaciones y reuniones. Una pantalla de alta definición y un sistema de sonido envolvente aseguran que cada detalle sea captado, ya sea en una conferencia o en una proyección multimedia. Las plantas cuidadosamente seleccionadas aportan un toque de naturaleza al ambiente, complementando el tono violeta con verdes vibrantes que refrescan el espacio. Además, los amplios ventanales permiten que la luz natural inunde la sala durante el día, haciendo que el espacio se sienta aún más abierto y aireado. Por la noche, la iluminación ajustable permite transformar la sala según las necesidades, desde una luz tenue para momentos íntimos hasta una iluminación más brillante para actividades dinámicas.\r\n\r\nLa versatilidad de la Sala Violeta la convierte en un lugar ideal para una amplia gama de eventos, desde reuniones profesionales hasta encuentros más personales, siempre ofreciendo una experiencia única y enriquecedora.\r\n\r\n'),
(2, 'Sala Amarilla', '#ffd22e', 'La Sala Amarilla es un espacio lleno de vitalidad y energía, diseñado para inspirar creatividad, dinamismo y colaboración. Al entrar, uno es recibido por el vibrante tono amarillo de las paredes, un color que evoca optimismo, felicidad y claridad mental. Este color ha sido cuidadosamente elegido por sus propiedades estimulantes, que no solo elevan el estado de ánimo de quienes lo habitan, sino que también promueven la actividad mental y la concentración. La luz natural se filtra a través de grandes ventanales cubiertos por cortinas ligeras, bañando el espacio con una calidez dorada que resalta cada detalle del mobiliario y los elementos decorativos, creando una atmósfera acogedora y estimulante.\r\n\r\nLos muebles en la Sala Amarilla están dispuestos estratégicamente para fomentar tanto la interacción grupal como el trabajo individual. Las sillas, de diseño moderno y ergonómico, están tapizadas en tonos que complementan la paleta de colores de la sala, como grises suaves y blancos neutros, proporcionando una base tranquila que equilibra la energía del amarillo dominante. Las mesas rectangulares, hechas de madera clara con acabados pulidos, son lo suficientemente amplias para albergar materiales de trabajo o actividades creativas, y están diseñadas para ser fácilmente movibles, permitiendo una disposición flexible según las necesidades del momento. Estas mesas, con bordes suaves y formas acogedoras, invitan tanto a la colaboración en grupo como a la reflexión individual.\r\n\r\nUno de los aspectos más atractivos de la Sala Amarilla es la incorporación de tecnología y recursos multimedia para facilitar la interacción y el aprendizaje. En una de las paredes, una gran pantalla táctil permite realizar presentaciones interactivas o trabajar de manera colaborativa en proyectos visuales. Este recurso tecnológico, junto con pizarras móviles que se encuentran distribuidas por todo el espacio, hacen de la sala un lugar ideal para reuniones de equipo, sesiones de lluvia de ideas, o actividades formativas que requieren el intercambio constante de ideas y la creación conjunta. Las pizarras, de diseño minimalista y funcional, son un punto focal para aquellos que deseen plasmar sus pensamientos de manera rápida y visual.', 'uploads/amarillo.png', '#b48913', 'El ambiente de la sala se equilibra con toques de naturaleza, como plantas en macetas de cerámica que adornan los rincones del espacio. Las plantas no solo añaden un toque de frescura, sino que también ayudan a purificar el aire y aportan un contraste visual agradable con el fondo amarillo. Las especies seleccionadas, como el ficus y las suculentas, son fáciles de cuidar y resistentes, lo que garantiza que el espacio se mantenga siempre lleno de vida. En el centro de la sala, un jarrón de vidrio con flores amarillas frescas, como girasoles o tulipanes, refuerza la paleta cromática del entorno y añade un toque vibrante que conecta el diseño del espacio con la naturaleza exterior.\r\n\r\nEl aroma predominante en la Sala Amarilla es una mezcla sutil de cítricos y frescura. Fragancias de limón, naranja y bergamota flotan en el aire, estimulando los sentidos y ayudando a mejorar la concentración y la energía. Este aroma, especialmente diseñado para complementar el color y la iluminación del espacio, tiene un efecto revitalizante sobre quienes lo perciben, ayudando a mantener el enfoque durante largas sesiones de trabajo o actividades creativas.\r\n\r\nEn cuanto a la iluminación, además de la luz natural que inunda la sala durante el día, el sistema de iluminación artificial ha sido diseñado para ser igualmente estimulante y funcional. Las lámparas colgantes, con tonos dorados y cálidos, crean una luz suave y envolvente que no solo es agradable a la vista, sino que también contribuye a mantener un nivel constante de energía en el ambiente. Los focos dirigidos iluminan las áreas de trabajo clave, mientras que las lámparas de pie situadas en los rincones proporcionan una luz ambiental que suaviza el espacio durante la tarde y noche, haciendo que la sala sea igualmente funcional en cualquier momento del día.\r\n\r\nUno de los elementos más interesantes de la Sala Amarilla es su capacidad para adaptarse a diferentes usos. Si bien está diseñada principalmente para actividades grupales y creativas, también se presta perfectamente para momentos de reflexión personal o trabajo en solitario. Los rincones de la sala están diseñados para ofrecer pequeñas áreas de descanso, con cómodos sillones y mesas auxiliares, donde los usuarios pueden relajarse, leer un libro o tomar un descanso entre sesiones. Estos espacios, alejados de las áreas de colaboración más activas, ofrecen un refugio tranquilo dentro de la sala vibrante, permitiendo que las personas alternen entre momentos de actividad intensa y descanso cuando lo necesiten.\r\n\r\nLa música que se escucha de fondo en la Sala Amarilla está seleccionada específicamente para mantener un ambiente de energía positiva sin distraer a los usuarios. Sonidos ligeros de jazz, música instrumental o ritmos suaves llenan el aire, creando un ambiente en el que el ritmo del trabajo fluye de manera natural. La música está diseñada para ser lo suficientemente sutil como para no interferir con las conversaciones o actividades, pero lo suficientemente presente como para mantener un ambiente alegre y productivo.'),
(3, 'Sala Naranja', '#ff9029', 'La \"Sala Naranja\" es un espacio vibrante y acogedor, diseñado para inspirar creatividad y colaboración. Este ambiente destaca por su decoración cálida y luminosa, con paredes pintadas en un tono naranja intenso que simboliza energía, entusiasmo y alegría. Es el lugar perfecto para reuniones dinámicas, talleres creativos, y sesiones de brainstorming, donde la innovación y la imaginación fluyen con facilidad.\r\n\r\nLa sala cuenta con amplias ventanas que permiten la entrada de luz natural, creando un ambiente abierto y aireado que favorece la concentración y el bienestar. El mobiliario ha sido cuidadosamente seleccionado para ofrecer comodidad y funcionalidad, con sillas ergonómicas y mesas modulares que se pueden reorganizar fácilmente según las necesidades de la actividad.', 'uploads/orange.png', '#e65d14', 'Además, la \"Sala Naranja\" está equipada con tecnología de punta, incluyendo pantallas interactivas, proyector de alta definición, y un sistema de sonido envolvente que asegura una excelente calidad audiovisual para presentaciones y videoconferencias. También dispone de conexión Wi-Fi de alta velocidad y múltiples puntos de carga para dispositivos electrónicos, lo que facilita un entorno de trabajo fluido y sin interrupciones.\r\n\r\nEl toque distintivo de esta sala es su atmósfera creativa, potenciada por elementos decorativos como plantas naturales, obras de arte moderno, y una paleta de colores que estimula la mente. Es un espacio donde las ideas se transforman en proyectos y donde cada reunión se convierte en una experiencia productiva y motivadora.\r\n\r\nLa \"Sala Naranja\" no es solo un lugar de trabajo, sino un entorno que promueve la innovación y el trabajo en equipo, haciendo que cada encuentro sea único y memorable.'),
(4, 'Sala Turquesa', '#27b9c4', 'La \"Sala Turquesa\" es un espacio sereno y sofisticado, diseñado para fomentar la calma y la concentración en cualquier actividad. Su nombre proviene del color que domina la decoración: un turquesa suave y relajante que evoca tranquilidad, claridad mental, y una sensación de frescura. Este ambiente es ideal para reuniones estratégicas, sesiones de meditación, o cualquier evento que requiera un enfoque profundo y reflexivo.\r\n\r\nLa sala cuenta con una iluminación cuidadosamente planeada, combinando luz natural a través de grandes ventanales con luces LED ajustables que permiten crear diferentes ambientes según la necesidad del momento. El mobiliario en la \"Sala Turquesa\" es minimalista y elegante, con mesas de líneas limpias y sillas confortables que ofrecen soporte ergonómico, invitando a la reflexión y al diálogo pausado.\r\n\r\n', 'uploads/turquesa.png', '#1e7b99', 'Un aspecto destacado de la \"Sala Turquesa\" es su integración tecnológica, que incluye una pantalla interactiva de última generación, proyector de alta resolución, y un sistema de audio discreto pero potente, ideal para presentaciones claras y reuniones en las que la comunicación efectiva es clave. La sala también ofrece conexión Wi-Fi de alta velocidad y varios puntos de carga, asegurando que todos los dispositivos estén siempre listos para su uso.\r\n\r\nEl ambiente de la \"Sala Turquesa\" se ve realzado por detalles decorativos que conectan con la naturaleza, como plantas en macetas y elementos de madera clara que añaden un toque orgánico y acogedor al entorno. La paleta de colores, centrada en el turquesa pero complementada con tonos neutros y acentos en blanco, crea un equilibrio perfecto entre frescura y profesionalismo.\r\n\r\nEste espacio ha sido diseñado para ser un refugio dentro del ajetreo cotidiano, un lugar donde las ideas pueden desarrollarse en un ambiente relajado y productivo. Ya sea para una reunión de equipo, una presentación importante, o simplemente un espacio para pensar, la \"Sala Turquesa\" proporciona el escenario ideal para alcanzar nuevos niveles de creatividad y éxito.\r\n\r\n'),
(5, 'Sala Verde', '#5ec918', 'La \"Sala Verde\" es un oasis de calma y revitalización en medio del ajetreo del día a día. Este espacio ha sido meticulosamente diseñado para ofrecer un entorno que fomente la conexión con la naturaleza, el bienestar y la creatividad. Las paredes de la sala están pintadas en un tono verde suave y refrescante, un color que simboliza crecimiento, equilibrio y renovación. Este entorno es ideal para actividades que requieran una mente despejada y una perspectiva fresca, como sesiones de planificación, reuniones estratégicas o incluso retiros de bienestar.\r\n\r\nLa sala está iluminada por luz natural que entra a través de amplios ventanales, complementada con iluminación LED ajustable que permite crear un ambiente acogedor y relajante a cualquier hora del día. El mobiliario ha sido seleccionado con un enfoque en la comodidad y la sostenibilidad, utilizando materiales reciclados y naturales que aportan una sensación de armonía con el entorno. Las sillas ergonómicas y las mesas de trabajo ajustables permiten adaptarse a cualquier tipo de reunión o actividad, ofreciendo la máxima flexibilidad y confort.', 'uploads/green (1).png', '#4d8712', 'La \"Sala Verde\" también está equipada con tecnología avanzada, incluyendo una pantalla interactiva de alta definición, un sistema de sonido envolvente, y una conexión Wi-Fi rápida y estable. Estos recursos tecnológicos están diseñados para facilitar presentaciones, videoconferencias y colaboraciones en tiempo real, asegurando que cada encuentro sea productivo y eficiente.\r\n\r\nUn aspecto distintivo de la \"Sala Verde\" es su decoración inspirada en la naturaleza. Las plantas de interior, cuidadosamente seleccionadas, no solo mejoran la calidad del aire sino que también crean un ambiente sereno que reduce el estrés y mejora la concentración. Elementos decorativos como cuadros de paisajes naturales y muebles de madera clara complementan la temática ecológica, haciendo de este espacio un verdadero refugio para el bienestar y la productividad.\r\n\r\nLa \"Sala Verde\" no es solo un lugar de trabajo, sino un entorno que invita a la reflexión y la regeneración. Es un espacio donde las ideas florecen, la creatividad se nutre y las personas se sienten revitalizadas y conectadas, tanto entre sí como con el mundo natural. Perfecta para reuniones de trabajo, talleres de desarrollo personal o cualquier evento que requiera un ambiente sereno y rejuvenecedor, la \"Sala Verde\" es el escenario ideal para alcanzar nuevos niveles de inspiración y éxito.'),
(6, 'Sala Roja', '#f13b3b', 'La \"Sala Roja\" es un espacio vibrante y enérgico, diseñado para inspirar pasión, acción y determinación. Este ambiente está dominado por un tono rojo profundo que simboliza fuerza, coraje y motivación, creando un entorno perfecto para actividades que requieran un alto nivel de compromiso y dinamismo. Es ideal para reuniones importantes, presentaciones de alto impacto, y sesiones de brainstorming donde la creatividad y la innovación son clave.\r\n\r\nLa iluminación de la \"Sala Roja\" está cuidadosamente planeada para complementar el ambiente vibrante del espacio. Grandes ventanales permiten la entrada de luz natural, mientras que las luces LED ajustables proporcionan la flexibilidad necesaria para crear distintos ambientes, desde uno brillante y estimulante para reuniones energéticas, hasta uno más tenue para momentos de reflexión y estrategia.', 'uploads/red.png', '#b51c1c', 'El mobiliario en la \"Sala Roja\" ha sido seleccionado para ofrecer tanto estilo como funcionalidad. Las sillas son ergonómicas y están diseñadas para proporcionar comodidad durante largas sesiones, mientras que las mesas modulares permiten una variedad de configuraciones, adaptándose a las necesidades específicas de cada reunión o evento. Los colores oscuros y los acentos metálicos en el mobiliario añaden un toque de sofisticación y profesionalismo al ambiente.\r\n\r\nTecnológicamente, la \"Sala Roja\" está equipada con lo último en innovación. Cuenta con una pantalla interactiva de alta definición, un sistema de sonido envolvente y una conectividad Wi-Fi robusta, asegurando que todas las presentaciones, videoconferencias y colaboraciones se realicen sin problemas. Este equipamiento avanzado convierte a la sala en un espacio ideal para lanzamientos de productos, reuniones de ventas, y cualquier otro evento que requiera una presentación impecable y persuasiva.\r\n\r\nLa decoración de la \"Sala Roja\" está pensada para potenciar el ambiente apasionado del espacio. Obras de arte contemporáneo con tonos rojos, esculturas metálicas y elementos decorativos que reflejan la energía y la intensidad del color rojo adornan las paredes y las estanterías, creando un entorno que inspira acción y decisión. Además, detalles como plantas naturales en macetas de diseño y alfombras en tonos neutros equilibran la fuerza del rojo, aportando un toque de calidez y confort.\r\n\r\nLa \"Sala Roja\" no es simplemente un lugar para reuniones, sino un catalizador para el éxito y la productividad. Es un espacio donde las ideas cobran vida, donde la energía se transforma en acción y donde cada encuentro tiene el potencial de ser decisivo. Ya sea para reuniones ejecutivas, presentaciones importantes o sesiones creativas, la \"Sala Roja\" proporciona el ambiente perfecto para llevar cualquier proyecto al siguiente nivel.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `ID` int(3) NOT NULL,
  `Turno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`ID`, `Turno`) VALUES
(1, 'Mañana'),
(2, 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tu_tabla_pdf`
--

CREATE TABLE `tu_tabla_pdf` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `PDF_Path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tu_tabla_pdf`
--

INSERT INTO `tu_tabla_pdf` (`ID`, `Nombre`, `PDF_Path`) VALUES
(2, 'PDF1', 'pdf/_.._storage_pdfs_english-text-body-parts.pdf'),
(3, 'PDF2', 'pdf/_.._storage_pdfs_english-text-environment.pdf'),
(4, 'PDF2', 'pdf/_.._storage_pdfs_english-text-environment.pdf'),
(9, 'PDF3', 'pdf/organizacion ymetodos.pdf'),
(10, 'PDF3', 'pdf/organizacion ymetodos.pdf'),
(11, 'PDF1', 'pdf/Estrategias de liderazgo.pdf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tu_tabla_pdf`
--
ALTER TABLE `tu_tabla_pdf`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tu_tabla_pdf`
--
ALTER TABLE `tu_tabla_pdf`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
