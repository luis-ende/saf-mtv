--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2 (Debian 13.2-1.pgdg100+1)
-- Dumped by pg_dump version 13.2 (Debian 13.2-1.pgdg100+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: preguntas_frecuentes; Type: TABLE DATA; Schema: public; Owner: saf_mtv_dbuser
--

INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (4, 1, 1, 'CLAVE CAMBSCDMX', 'Son las claves que se encuentran dentro del Catálogo de de Adquisiciones, Bienes Muebles y Servicios de la Ciudad de México.', '2023-03-02 21:49:40', '2023-03-02 21:49:40');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (12, 1, 1, 'Precotización', 'Solicitud de un precio unitario aproximado de un bien o servicio con características especificas.', '2023-03-02 21:49:40', '2023-03-02 21:49:40');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (13, 1, 2, '¿Quién realiza las compras públicas?', 'Las Instituciones compradoras (Unidades Responsables de Gasto).', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (16, 1, 2, 'Si resido en otra entidad federativa, ¿Puedo venderle al gobierno de la CDMX?', 'Sí, siempre y cuando cumplas con los requisitos estipulados en cada uno de los procedimientos. ', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (2, 1, 1, 'Rubro de gasto', '<p>Es el <strong>mayor nivel</strong> de agregación que identifica el conjunto homogéneo y ordenado <strong>de los bienes y servicios requeridos por los entes públicos.</strong></p>', '2023-03-02 21:49:40', '2023-03-10 16:43:52');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (19, 1, 2, '¿Cuáles son los requisitos para participar en un procedimiento?', '<p><strong>Al encontrar una oportunidad de negocio</strong> de tu interés, dentro del recuadro, <strong>da clic al botón dorado</strong> el cuál <strong>te llevará a la página donde se muestra el detalle</strong> del procedimiento, requisitos de compra y fechas.</p>', '2023-03-02 21:49:41', '2023-03-10 17:13:55');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (20, 1, 2, '¿Qué periodicidad tienen las compras públicas?', '<p>Debido a la periódica necesidad de adquisición de suministros e innovaciones públicas, el gobierno de la CDMX tiene un constante requerimiento para la adquisición de bienes pero todo depende de cada una de las dependencias. Te invitamos a acceder a la página de <a href="https://prebasestianguisdigital.cdmx.gob.mx/">Prebases de Tianguis Digital</a> para seguir cada uno de los procedimientos.</p>', '2023-03-02 21:49:41', '2023-03-10 17:15:01');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (3, 1, 1, 'Catálogo de Rubros, Bienes/Servicios', '<p>Es el <strong>Catálogo de Adquisiciones, Bienes Muebles y Servicios de la Ciudad de México</strong>, en el cual se puede encontrar el <strong>listado de Claves CAMBSCDMX</strong>, asi como las <strong>partidas</strong> de bienes, muebles y servicios.</p>', '2023-03-02 21:49:40', '2023-03-10 17:17:24');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (5, 1, 1, 'Partida', '<p>Es el nivel de agregación más específico en el cual se describen las expresiones concretas y detalladas de los bienes y servicios que se adquieren y se compone de: a) <strong>Partida Genérica:</strong> se refiere al tercer dígito, el cual logrará la armonización a todos los niveles de gobierno. b) <strong>Partida Específica:</strong> corresponde al cuarto dígito, el cual permitirá que las unidades administrativas o instancias competentes en materia de Contabilidad Gubernamental y de Presupuesto de cada orden de gobierno, con base en sus necesidades, generen su apertura, conservando la estructura básica (capítulo, concepto y partida genérica), con el fin de mantener la armonización con el Plan de Cuentas.</p>', '2023-03-02 21:49:40', '2023-03-10 17:18:23');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (6, 1, 1, 'Métodos de contratación', '<p>Las CDMX realiza sus compras a través de procedimientos como <strong>Licitación Pública (LP), Invitación Restringida (IR) o Adjudicación Directa (AD)</strong>, apegándose a los lineamientos que la Ley de Adquisiciones para la Ciudad de México lo establece.</p>', '2023-03-02 21:49:40', '2023-03-10 17:18:59');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (7, 1, 1, 'Procedimiento', '<p>Es una <strong>serie de trámites</strong> que realizan las dependencias y organismos descentralizados de la administración pública con la <strong>finalidad de producir y ejecutar un acto administrativo</strong>.&nbsp;</p>', '2023-03-02 21:49:40', '2023-03-10 17:19:39');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (8, 1, 1, 'Licitación Pública (LP)', '<p>Son procesos donde el gobierno lanza <strong>convocatorias</strong> para pedir cierto producto. También se les conoce como <strong>“Concursos”</strong>.</p>', '2023-03-02 21:49:40', '2023-03-10 17:20:28');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (10, 1, 1, 'Adjudicación Directa (AD)', '<p><strong>Procedimiento de contratación</strong> previsto por los artículos 26, fracción II, 41 y 42 de la Ley de Adquisiciones, Arrendamientos y Servicios del Sector Público, que <strong>permite al Consejo otorgarle un contrato a una determinada persona (física o moral)</strong>, buscando las mejores condiciones para el Estado.</p>', '2023-03-02 21:49:40', '2023-03-10 17:22:21');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (11, 1, 1, 'Prebase', '<p><strong>Proyectos de contratación pública</strong> de la Ciudad de México que <strong>están en planeación y abiertos a discusión pública.</strong></p>', '2023-03-02 21:49:40', '2023-03-10 17:23:00');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (18, 1, 2, '¿Qué tengo que hacer para participar en los procedimientos?', '<p>Para participar en cualquier tipo de procedimiento debes estar inscrito en el <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/requisitos">Padrón de Proveedores</a> y contar con una constancia vigente durante el procedimiento. La vigencia de esta constancia es de un año y deberás renovarla para poder participar. Si cuentas con tu registro y constancia vigente, te invitamos a visitar la página <a href="https://www.tianguisdigital.cdmx.gob.mx/">Tianguis Digital</a> y revisar el detalle de las licitaciones para valorar si cumples con los requisitos y condiciones para participar. Para comprar las bases y participar, consulta la fecha para acudir al domicilio y horario referido.</p>', '2023-03-02 21:49:41', '2023-03-14 17:48:12');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (17, 1, 2, 'Si soy una MiPyME, ¿Puedo colaborar con el gobierno de la CDMX?', '<p>Sí, por supuesto. Uno de los objetivos de Mi Tiendita Virtual es apoyar a las Micro, Pequeñas y Medianas empresas para conocer cómo venderle a la CDMX y acompañarlos en el proceso. Estas en el sitio correcto para conocer cómo convertirte en proveedor de la CDMX. Visita nuestro <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/info-venderle-a-cdmx">Flujograma </a>para conocer cómo convertirte en proveedor de la CDMX.</p>', '2023-03-02 21:49:41', '2023-03-14 17:50:15');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (15, 1, 2, '¿Cómo puedo saber si mi producto o servicio lo compra la CDMX?', '<p>Para conocer qué productos compra la CDMX utiliza el buscador de la sección <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/oportunidades-de-negocio">Oportunidades de negocio</a>. Sólo teclea el nombre de tu producto y revisa las oportunidades encontradas. Para ayudarte a buscar tu producto, puedes visitar el <a href="http://rmsg.df.gob.mx/rmsg/modulo/dai/cabms/">Catálogo de Rubros, Bienes/Servicios</a>.</p>', '2023-03-02 21:49:41', '2023-03-15 14:58:59');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (14, 1, 2, '¿Cómo saber que instituciones requieren bienes o servicios?', '<p>Al ingresar a la sección<a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/oportunidades-de-negocio"> Oportunidades de negocio</a> podrás visualizar todos los<strong> procedimientos programados y vigentes organizados por Institución compradora</strong> y en los cuáles puedes participar. Utiliza los filtros para afinar tu búsqueda.</p>', '2023-03-02 21:49:41', '2023-03-15 14:50:33');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (23, 1, 3, '¿Qué es una matriz de escalamiento?', 'Una matriz de escalamiento es la información sobre a quién deben dirigirse las Instituciones compradoras para solicitar más información o si se produce un determinado incidente.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (25, 1, 3, 'Si ya estoy registrado en el Padrón de Proveedores, ¿Debo registrarme de aquí?', 'No. Puedes utilizar la misma cuenta para ambas plataformas.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (36, 2, 1, '¿Qué actividades preponderantes debo registrar en la plataforma? ', 'Las actividades económicas que hayas reportado en tu constancia de situación fiscal vigente ante el SAT (con fecha de expedición no mayor a dos meses).', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (24, 1, 3, '¿Por qué me piden mi eFIrma en el registro?', '<p>Para registrarte en Mi Tiendita Virtual se requiere tu RFC con homoclave y datos personales y de tu negocio. Estos datos los tiene tu eFirma por lo tanto <strong>tu registro será más rápido si cuentas con ésta y la utilizas para registrarte</strong>. Además, este archivo es uno de <strong>los requisitos para participar en los procedimientos vigentes.</strong> Si quieres más información sobre tu eFirma, visita la <a href="https://www.gob.mx/tramites/ficha/obtencion-de-e-firma/SAT137">página del SAT</a>.</p>', '2023-03-02 21:49:41', '2023-03-10 16:53:25');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (26, 1, 3, 'Si ya tengo un catálogo en formato PDF, ¿Debo crear otro en Mi Tiendita Virtual?', '<p>Sí, ya que uno de los objetivos de la plataforma es que las Instituciones compradoras conozcan tu empresa y tus productos. El <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/buscador-mtv/productos">buscador de productos</a> sólo analiza datos e información registrados en el sitio, no archivos PDF. <strong>Registrar tus productos es sencillo por eso te animamos a dar de alta por lo menos uno.</strong></p>', '2023-03-02 21:49:41', '2023-03-15 14:46:09');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (28, 1, 3, 'Para registrar mis productos, ¿Qué datos me solicitan?', '<p>Los <strong>datos obligatorios</strong> son: nombre y descripción de tu producto. El nombre de tu producto aparecerá en la publicación. Los <strong>datos opcionales</strong> son: Marca, Modelo o SKU, Color(es), Material, Código de barras. Además puedes guardar hasta tres imágenes así como hasta dos documentos que expliquen mejor tu producto (ficha técnica, folleto, manual).</p>', '2023-03-02 21:49:41', '2023-03-10 17:00:10');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (29, 1, 3, 'Si tengo más de 10 productos, ¿Los debo registrar uno por uno?', '<p>No necesariamente. Si quieres registrar varios productos puedes optar por alguna de estas opciones: <strong>1) Registrar tus productos poco a poco</strong>. Para crear tu catálogo solo se requiere registrar un producto, pero entre más agregues, más Instituciones te encontrarán. 2) Puedes registrar tus productos mediante una carga masiva para lo cual se te proporciona la plantilla en formato XLS. Sólo se permite una carga masiva por usuario.</p>', '2023-03-02 21:49:41', '2023-03-10 17:01:52');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (30, 1, 3, 'Si utilicé la carga masiva pero me equivoqué en algún dato, ¿Puedo corregirlo?', '<p>Claro que sí. <strong>La carga masiva te ayuda a agilizar el proceso de registro de productos</strong> sobre todo cuando quieres agregar varios a la vez. Sólo tienes que <strong>finalizar el proceso de carga</strong> y después, en la sección Mi tiendita virtual (catálogo) <strong>podrás editar producto por producto</strong>. Sólo ingresa a la ficha del que quieres modificar y <strong>da clic en el botón "Editar"</strong>.</p>', '2023-03-02 21:49:41', '2023-03-10 17:03:00');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (21, 1, 2, '¿En dónde puedo conseguir información sobre las compras del siguiente año?', '<p>En la página <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/calendario-compras">Calendario de compras</a> de Mi Tiendita Virtual encuentras todo lo que la CDMX planea comprar para el siguiente año. La información está organizada por Institución compradora y puedes descargar el detalle ya sea en PDF o en XLS. También puedes visitar la sección <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/oportunidades-de-negocio">Oportunidades de negocio</a> en la cual encontrarás los procedimientos programados y los vigentes.</p>', '2023-03-02 21:49:41', '2023-03-15 14:49:20');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (31, 1, 3, 'Si quiero actualizar los datos de mi negocio, ¿En qué sección lo puedo hacer?', '<p>Ingresando al sistema, en la <strong>esquina superior derecha</strong> encontrarás tu nombre, despliega el menú y elige la sección <strong>Perfil</strong>. Ahí puedes corregir o actualizar tus datos.</p>', '2023-03-02 21:49:41', '2023-03-15 14:35:07');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (33, 2, 1, '¿Qué es el Padrón de Proveedores?', '<p>El Padrón de Proveedores de la administración pública de la CDMX es una <strong>plataforma que pertenece a Tianguis Digital</strong>. En este sistema <strong>las personas físicas y morales se registran para participar en procedimientos de compra-venta con el gobierno de la CDMX</strong> y así iniciar una relación cliente-proveedor con la CDMX. Además, <strong>es un canal de comunicación e información de oportunidades de negocio.&nbsp;</strong></p>', '2023-03-02 21:49:41', '2023-03-10 17:28:54');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (35, 2, 1, '¿Cuánto tiempo tarda el registro en el Padrón de Proveedores?', '<p><strong>15 días hábiles</strong>, sin embargo, el proveedor debe estar atento a su cuenta en Padrón de Proveedores y al correo electrónico registrado, posterior al envío del registro por si la documentación remitida presenta alguna observación, respecto a su llenado.&nbsp;</p>', '2023-03-02 21:49:41', '2023-03-10 17:29:59');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (37, 2, 1, '¿Es obligatorio el registro público de propiedad y comercio?', '<p><strong>Es obligatorio que el acta constitutiva</strong> venga acompañada de su <strong>boleta de inscripción o sello ante el Registro Público de Propiedad y Comercio</strong>, del mismo modo en caso de que las facultades asignadas al <strong>representante legal se valen a través de un poder notarial, este también deberá contar con su registro público correspondiente.</strong></p>', '2023-03-02 21:49:41', '2023-03-10 17:30:57');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (38, 2, 1, 'Si soy persona física, ¿Es obligatorio contar registro patronal ante el IMSS?', '<p><strong>No es un requisito obligatorio para personas físicas que reporten hasta 4 trabajadores</strong>. En caso de reportar 5 o más trabajadores se considerará como un requisito obligatorio.</p>', '2023-03-02 21:49:41', '2023-03-10 17:31:28');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (32, 1, 3, '¿Por qué el buscador de oportunidades de negocio no encuentra mi producto?', '<p>Si el buscador no arroja resultados, no te desanimes, puede ser porque el procedimiento de compra no ha iniciado. Visita la sección <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/calendario-compras">Calendario de compras</a> y <strong>consulta la programación para el siguiente año</strong>, así puedes conocer si tu bien o servicio está programado en las compras de la CDMX.&nbsp;</p>', '2023-03-02 21:49:41', '2023-03-15 13:57:37');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (27, 1, 3, '¿En qué sección agrego mis productos?', '<p>Primero, ingresa a <a href="https://mitienditavirtual.finanzas.cdmx.gob.mx/">Mi Tiendita Virtual</a> y en el menú encontrarás la opción "Mi Tiendita Virtual". También puedes ingresar desde el menú que se ubica en la esquina superior derecha a lado de tu nombre.&nbsp;</p>', '2023-03-02 21:49:41', '2023-03-15 14:45:13');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (42, 2, 2, 'Para ingresar al sistema, ¿Se debe crear una cuenta?', 'No, para ingresar solo se solicita tener FIEL/eFirma vigente.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (46, 3, 1, '¿Quién me puede proporcionar usuario y clave de acceso al sistema?', 'La DGRMSG comunicó a cada institución la contraseña. En caso de no contar con ella, el DGA u homólogo deberá solicitarla mediante oficio a la titular de la DGRMSG y luego proporcionar a la persona responsable del sistema.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (47, 3, 1, '¿Cómo se encuentran los lineamientos y cuáles son los más actualizados?', 'En la plataforma de PAAAPS, en la columna del lado izquierdo hay una sección que dice "listar lineamientos", dar clic y ahí se enlistan los Lineamientos de PAAAPS. Ya se pueden consultar los Lineamientos PAAAPS 2022 y el Instructivo 2022.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (48, 3, 1, '¿Quién puede dar las claves presupuestarias?', 'El área financiera de cada Unidad Responsable de Gasto.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (49, 3, 1, '¿Qué pasa si la clave CABMS CDMX o la unidad de medida que quiero registrar no está en la plataforma ni en el catálogo de claves CABMS CDMX?', 'Si la clave no existe deben de crearla. Para crearla deben enviar un oficio a la Dirección Ejecutiva de Almacenes de DGRMSG. Deben de realizar el envío de un oficio formalizado de solicitud de códigos. En donde se solicite que se proporcione un código/clave, así como la inserción en el Catálogo de Adquisiciones de Bienes Muebles y Servicios de la Ciudad de México. En donde se establezca qué bien o servicio se desea crear la clave y su descripción. Enviar un oficio dirigido al Director Ejecutivo de Almacenes e Inventarios, C. Catalino Alamina Argaiz, con la petición para la asignación de las descripciones. Correos: calamina@finanzas.cdmx.gob.mx; mvidalf@cdmx.gob.mx y mkfranco06@hotmail.com.mx', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (50, 3, 1, '¿Cuál es el número de procedimiento?', 'Es el número que le dan al proceso en cada URG desde la requisición, estudio de precios. Todo deben identificarlo con un número.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (51, 3, 1, '¿Cuál es el compromiso presupuestal?', 'El compromiso presupuestal es el número de registro del contrato en el sistema SAP-GRP.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (52, 3, 1, '¿Qué pasa si ya en la carga trimestral actual no se tiene el compromiso presupuestal?', 'Eso se debe de regularizar antes y en caso que no lo tengan deberán poner "0" y tendrán que solicitar la apertura del trimestre cuando ya tengan el número de compromiso presupuestal para poder registrarlo. Para solicitud de apertura consultar la página 74 de los lineamientos.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (53, 3, 1, 'Si se registró un compromiso presupuestal nada más para cumplir en tiempo con la entrega y llenado, ¿Cómo se puede corregir después?', 'Esto no debería ocurrir. Si así lo hizo, debe corregirlo a la brevedad. Se deberá hacer solicitando la apertura del trimestre cuando ya tengan el número de compromiso presupuestal para poder registrarlo. Para solicitud de apertura consultar la página 74 de los lineamientos.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (54, 3, 1, '¿Qué es un gasto operativo y que es un gasto sustantivo?', 'Gasto operativo es un gasto a cargo de Áreas Operadoras adscritas a la estructura administrativa de la SAF. Gasto sustantivo es un gasto a cargo de Áreas Operadoras no adscritas a la estructura administrativa.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (55, 3, 1, '¿Qué acuses son los que tengo que generar?', 'Analítico por adquisición de conformidad con la Ley de Adquisiciones para el Distrito Federal, a cargo de los capítulos de gasto 1000, 2000, 3000, 4000 y 5000, 2. Resumen presupuestal y concentrado 3. Resumen Presupuestal (Capítulo).', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (56, 3, 1, '¿Qué se debe hacer después de cargar todo el PAAAPS?', 'Hay que dar clic en la opción en la página de resumen que dice "Terminar PAAAPS" para poder generar los acuses.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (57, 3, 1, '¿Qué pasa con el resto del presupuesto que no ocupa este trimestre?', 'Todo el presupuesto se debe agregar por medio de procedimientos y contratos. El sistema no guarda restantes. Si se utilizó un procedimiento y se convirtió en contrato, pero con un monto menor al presupuestado por contrato, se debe volver a hacer un procedimiento reprogramando lo restante en caso de que esté planeado para otro trimestre. Si se presupuestó para el trimestre y se planea usar en otro semestre se debe hacer la modificación de fecha en el procedimiento.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (58, 3, 1, '¿Cómo se hace para registrar un ahorro?', 'Ir a actualización trimestral, ir al trimestre donde se quiere registrar el ahorro, ir al contrato que tuvo mejora o ahorro, dar clic en acciones y agregar ahorro.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (59, 3, 1, 'Se tuvo una reducción en el presupuesto de la URG porque asignaron menos este año que el pasado, ¿Se puede reportar como ahorro?', 'No, reducción de gasto no es ahorro.', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (60, 3, 1, '¿Si ya se cerró el trimestre aún se puede reportar ahorros?', 'LINEAMIENTOS PAAAPS 2022', '2023-03-02 21:49:41', '2023-03-02 21:49:41');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (40, 2, 1, '¿Es obligatorio el llenado de la sección "Responsabilidad Salarial"?', '<p><strong>No es obligatorio para personas físicas ni para personas morales</strong>. Únicamente deberás adjuntar la documentación solicitada cuando quieras obtener la condición de responsabilidad salarial.</p>', '2023-03-02 21:49:41', '2023-03-10 17:34:27');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (41, 2, 2, '¿Cómo se ingresa al sistema de precotizaciones digitales?', '<p>Al recibir la i<strong>nvitación para precotizar</strong>, en el mismo correo <strong>te llegará la liga para ingresar al sistema</strong>. Una vez dentro, para cotizar <strong>debes ingresar con su FIEL/eFirma</strong>. Visita este enlace para más información: <a href="https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login">https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login</a></p>', '2023-03-02 21:49:41', '2023-03-10 17:37:00');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (43, 2, 2, 'Si no puedo visualizar el anexo técnico de la requisición, ¿Qué pasos debo seguir?', '<p>Si no se observa un anexo técnico adjunto <strong>es porque no se cargó alguno</strong>. Por otro lado, <strong>si sí se cargó alguno y no se puede visualizar</strong> puede deberse a una falla del sistema. En este caso <strong>ayúdanos a reportarlo para que se revise lo más pronto posible.</strong></p>', '2023-03-02 21:49:41', '2023-03-10 17:38:01');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (45, 2, 2, '¿Por qué hay requisiciones con anexos y otras no?', '<p><strong>Depende del tipo de requisición</strong>, en ocasiones los archivos exceden el tamaño permitido que soporta la plataforma, por eso no se pueden visualizar.</p>', '2023-03-02 21:49:41', '2023-03-10 17:38:35');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (44, 2, 2, 'Si no puedo visualizar las características de los bienes que necesito cotizar, ¿Qué puedo hacer?', '<p>Si no existe un campo de características, para poder visualizarlas se debe <strong>revisar si se adjuntó un anexo técnico en la solicitud de cotizaciones</strong>.</p>', '2023-03-02 21:49:41', '2023-03-15 14:20:12');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (22, 1, 3, 'Para registrar mi negocio, ¿Qué datos me solicitan?', '<p>Para iniciar el registro se te solicitará tu <strong>CURP, RFC con homoclave, un correo electrónico y una contraseña</strong>. Para registrar <strong>tu negocio</strong> se solicita el domicilio de tu negocio <strong>y datos de éste como sector comercial</strong>, si perteneces a un <strong>sector prioritario, tipo de empresa, giro, nombre comercial, lema, la descripción</strong> de tu negocio <strong>y tus diferenciadores</strong>. Si lo deseas, puedes adjuntar la carta de presentación y tu catálogo de productos en formato PDF (no más de 3MB). También puedes agregar las <strong>redes sociales y sitio web</strong>, así como los <strong>datos de las personas clave de tu negocio</strong> (nombre, cargo, teléfono, correo electrónico. Estos medios de contacto facilitarán que las Instituciones compradoras te contacten.</p>', '2023-03-02 21:49:41', '2023-03-10 16:48:27');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (9, 1, 1, 'Invitación Restringida (IR)', '<p>Se trata de un procedimiento administrativo que permite a las dependencias, órganos desconcentrados, delegaciones y entidades, en <strong>forma discrecional a contratar obra o servicios</strong> relacionados con la misma, <strong>invitando a por lo menos tres oferentes a presentar propuestas</strong>. Estos actos tienen básicamente las mismas formalidades de una licitación pública a excepción que <strong>no está sujeta a la emisión de una convocatoria ni a términos específicos</strong>, además <strong>no es un procedimiento público</strong> en el que pudiera participar cualquier interesado ya que están supeditados a la invitación que las áreas convocantes realicen y que los participantes acepten, solicitándoles un cheque cruzado, certificado o de caja, como garantía de que presentarán propuestas.</p>', '2023-03-02 21:49:40', '2023-03-10 17:21:46');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (1, 1, 1, 'Institución compradora', '<p>Las Instituciones compradoras (Unidades Responsables de Gasto) son las <strong>áreas encargadas de ejercer el gasto público realizando procedimientos de carácter público</strong> como licitaciones, invitaciones restringidas y adjudicaciones directas <strong>con la finalidad de atender las necesidades que sus instituciones presentan</strong> (Organismos Autónomos, Dependencias, Órganos Desconcentrados, Alcaldías y Entidades). Estas son las <strong>encargadas de la creación y publicación de dichos procedimientos</strong> para la adquisición de bienes o servicios con aquellos proveedores (personas físicas o morales) participantes. Las Instituciones compradoras <strong>revisarán y validarán la documentación correspondiente para la debida integración de expedientes</strong> de aquellos proveedores participantes adjudicados.</p>', '2023-03-02 21:49:40', '2023-03-10 17:25:39');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (34, 2, 1, '¿Qué es la constancia que expide el Padrón de Proveedores?', '<p>Es la constancia que <strong>avala tu inscripción al Padrón de Proveedores</strong>. Para tramitarla debes proporcionar datos y documentación relacionada con la identidad de la persona física o moral, indicar el representante legal, así como los datos de contacto, los requisitos fiscales y responsabilidad salarial. La constancia del Padrón de Proveedores <strong>es obligatoria para todo proveedor contratado a partir del 03 de septiembre del 2018</strong>, por tanto es un requisito obligatorio para participar en procedimientos de contratación.</p>', '2023-03-02 21:49:41', '2023-03-10 17:29:46');
INSERT INTO public.preguntas_frecuentes (id, categoria, subcategoria, pregunta, respuesta, created_at, updated_at) VALUES (39, 2, 1, 'Si soy persona moral, ¿Es obligatorio contar registro patronal ante el IMSS?', '<p>Sí, es un <strong>requisito que se considerará obligatorio en caso de personas morales</strong>. Debe presentar la tarjeta de identificación patronal (TIP) vigente (con fecha de expedición no mayor a 2 años), o en su caso presentar la TIP digital. Cabe mencionar que este documento debe acompañarse por su respectiva opinión de cumplimiento en materia de seguridad social emitida por el IMSS.</p>', '2023-03-02 21:49:41', '2023-03-10 17:33:04');


--
-- Name: preguntas_frecuentes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: saf_mtv_dbuser
--

SELECT pg_catalog.setval('public.preguntas_frecuentes_id_seq', 60, true);


--
-- PostgreSQL database dump complete
--

