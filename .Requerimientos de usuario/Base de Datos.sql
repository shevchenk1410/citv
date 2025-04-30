/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : 127.0.0.1:3306
 Source Schema         : citv

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 29/04/2025 23:34:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aseguradora
-- ----------------------------
DROP TABLE IF EXISTS `aseguradora`;
CREATE TABLE `aseguradora`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_poliza_id` bigint(20) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 68 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aseguradora
-- ----------------------------
INSERT INTO `aseguradora` VALUES (1, 'INTERSEGURO', 1, 1);
INSERT INTO `aseguradora` VALUES (2, 'RIMAC SEGUROS', 1, 1);
INSERT INTO `aseguradora` VALUES (3, 'LA POSITIVA', 1, 1);
INSERT INTO `aseguradora` VALUES (4, 'MAPFRE PERU', 1, 1);
INSERT INTO `aseguradora` VALUES (5, 'PACIFICO SEGUROS', 1, 1);
INSERT INTO `aseguradora` VALUES (6, 'HDI SEGUROS S.A.', 1, 1);
INSERT INTO `aseguradora` VALUES (7, 'SEGUROS SURA', 1, 1);
INSERT INTO `aseguradora` VALUES (8, 'PROTECTA', 1, 1);
INSERT INTO `aseguradora` VALUES (9, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO CHIMBOTE \"AFOCAT CHIMBOTE REGION ANCASH\"', 2, 1);
INSERT INTO `aseguradora` VALUES (10, 'ASOCIACION FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO DE ANCASH \"AFOCAT - ANCASH\"', 2, 1);
INSERT INTO `aseguradora` VALUES (11, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRÁNSITO LA ÚNICA \"AFOCAT LA ÚNICA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (12, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION AREQUIPA \"AFOCAT - REGION AREQUIPA\"', 2, 0);
INSERT INTO `aseguradora` VALUES (13, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DEL FRENTE UNICO DE TRANSPORTE PUBLICO URBANO E INTERURBANO DE LA REGION AREQUIPA \"AFOCAT FUTUIRA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (14, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION AREQUIPA Y ANEXOS \"AFOCAT RAVISUR\"', 2, 1);
INSERT INTO `aseguradora` VALUES (15, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION DE CAJAMARCA \"AFOCAT - REGION CAJAMARCA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (16, 'ASOCIACION FONDO DE COBERTURAS DE ACCIDENTES DE TRANSITO DEL CUMBE \"AFOCATCDC\"', 2, 1);
INSERT INTO `aseguradora` VALUES (17, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION CUSCO \"AFOCAT REGION CUSCO\"', 2, 1);
INSERT INTO `aseguradora` VALUES (18, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LA SOLUCION DEL CUSCO \"AFOCAT LA SOLUCIÓN CUSCO\"', 2, 1);
INSERT INTO `aseguradora` VALUES (19, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO REGIONAL BELLA DURMIENTE \"AFOCAT REGIONAL BELLA DURMIENTE\"', 2, 1);
INSERT INTO `aseguradora` VALUES (20, 'ASOCIACIÓN FONDO CONTRA ACCIDENTES DE TRÁNSITO REGIONAL LEON DE HUÁNUCO \"AFOCAT LEÓN DE HUÁNUCO\"', 2, 1);
INSERT INTO `aseguradora` VALUES (21, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION ICA \"AFOCAT REGION ICA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (22, 'ASOCIACIÓN DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO EL ÁNGEL \"AFOCAT EL ÁNGEL\"', 2, 1);
INSERT INTO `aseguradora` VALUES (23, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION JUNIN \"AFOCAT - JUNIN\"', 2, 1);
INSERT INTO `aseguradora` VALUES (24, 'ASOCIACIÓN DE FONDO CONTRA ACCIDENTES DE TRANSITO UNION \"AFOCAT\"', 2, 1);
INSERT INTO `aseguradora` VALUES (25, 'ASOCIACIÓN DE FONDO CONTRA ACCIDENTES DE TRANSITO DE LOS TRANSPORTISTAS DE LA REGION JUNIN PASCO HUANUCO \"AFOCAT R.J.P.H.\"', 2, 1);
INSERT INTO `aseguradora` VALUES (26, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO MACRO REGION NOR-ORIENTE \"AFOCAT - CENTRO NOR - ORIENTE\"', 2, 1);
INSERT INTO `aseguradora` VALUES (27, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LA LIBERTAD \"AFOCAT - TRUJILLO REGION LA LIBERTAD\"', 2, 1);
INSERT INTO `aseguradora` VALUES (28, 'ASOCIACION FONDO DE COBERTURA DE ACCIDENTES DE TRANSITO - LA LIBERTAD \"AFOCAT LA LIBERTAD\"', 2, 1);
INSERT INTO `aseguradora` VALUES (29, 'ASOCIACION FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO NUEVO HORIZONTE REGION LA LIBERTAD \"AFOCAT NUEVO HORIZONTE REGION LA LIBERTAD\"', 2, 1);
INSERT INTO `aseguradora` VALUES (30, 'ASOCIACION DE USUARIOS DEL FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO - FORCAT \"FORCAT\"', 2, 1);
INSERT INTO `aseguradora` VALUES (31, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LIDER PERU \"AFOCAT LÍDER PERÚ\"', 2, 1);
INSERT INTO `aseguradora` VALUES (32, 'AUTOSEGUROS DE FONDOS CONTRA ACCIDENTES DE TRANSITO DE LIMA \"AUTOSEGUROS AFOCAT LIMA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (33, 'AUTOSEGURO ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO \"\"AUTOSEGURO AFOCAT\"\"', 2, 1);
INSERT INTO `aseguradora` VALUES (34, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LIMA METROPOLITANA \"AFOCAT LIMA METROPOLITANA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (35, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LIMA METROPOLITANA Y PROVINCIA CONSTITUCIONAL DEL CALLAO \"AFOCAT - REGION LIMA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (36, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO PREMIUM \"AFOCAT PREMIUM\"', 2, 1);
INSERT INTO `aseguradora` VALUES (37, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO SOCAT PERU \"AFOCAT SOCAT PERÚ\"', 2, 0);
INSERT INTO `aseguradora` VALUES (38, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO (AFOCAT) NUESTRA SEÑORA DE LA ASUNCIÓN \"NUESTRA SEÑORA DE LA ASUNCIÓN\"', 2, 1);
INSERT INTO `aseguradora` VALUES (39, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LIMA PROVINCIAS \"AFOCAT LIMA\"', 2, 0);
INSERT INTO `aseguradora` VALUES (40, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO ORIENTE - REGION LORETO \"AFOCAT DEL ORIENTE - REGION LORETO\"', 2, 1);
INSERT INTO `aseguradora` VALUES (41, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO DE LA REGION MOQUEGUA \"AFOCAT MOQUEGUA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (42, 'ASOCIACION DEL FONDO CONTRA ACCIDENTES DE TRANSITO - AFOCAT TRANS REGION PIURA \"AFOCAT TRANS REGION PIURA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (43, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO - PIURA \"AFOCAT - PIURA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (44, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LA PRIMERA \"AFOCAT LA PRIMERA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (45, 'FONDO CONTRA ACCIDENTES DE TRANSITO REGIÓN PUNO \"FONCAT\"', 2, 0);
INSERT INTO `aseguradora` VALUES (46, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE PUNO \"AFOCAT PUNO\"', 2, 0);
INSERT INTO `aseguradora` VALUES (47, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION SAN MARTIN \"AFOCAT REGION SAN MARTIN\"', 2, 1);
INSERT INTO `aseguradora` VALUES (48, 'ASOCIACIÓN DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO AFOCAT - AFOSECAT - SAN MARTIN \"AFOCAT - AFOSECAT - SAN MARTÍN\"', 2, 1);
INSERT INTO `aseguradora` VALUES (49, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO SUR PERÚ REGION TACNA \"AFOCAT SUR PERÚ REGIÓN TACNA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (50, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO REGION TACNA \"AFOCAT REGION TACNA\"', 2, 1);
INSERT INTO `aseguradora` VALUES (51, 'FONDO DE ASISTENCIA SOCIAL DE LOS MOTOTAXISTAS Y TRANSPORTISTAS DE TUMBES \"FASMOT\"', 2, 1);
INSERT INTO `aseguradora` VALUES (52, 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO REGIONAL UCAYALINO \"AFOCAT UCAYALINO REGIÓN UCAYALI\"', 2, 1);
INSERT INTO `aseguradora` VALUES (53, 'BNP PARIBAS CARDIF', 1, 1);
INSERT INTO `aseguradora` VALUES (54, 'CRECER SEGUROS S. A.', 1, 1);
INSERT INTO `aseguradora` VALUES (55, 'INSUR', 1, 1);
INSERT INTO `aseguradora` VALUES (56, 'CHUBB PERU', 1, 1);
INSERT INTO `aseguradora` VALUES (57, 'RIMAC SEGUROS', 1, 1);
INSERT INTO `aseguradora` VALUES (58, 'VIVIR SEGUROS', 1, 1);
INSERT INTO `aseguradora` VALUES (59, 'OHIO NACIONAL VIDA', 1, 1);
INSERT INTO `aseguradora` VALUES (60, 'COFACE', 1, 1);
INSERT INTO `aseguradora` VALUES (61, 'AVLA PERU', 1, 1);
INSERT INTO `aseguradora` VALUES (62, 'LIBERTY SEGUROS', 1, 1);
INSERT INTO `aseguradora` VALUES (63, 'SECREX', 1, 1);
INSERT INTO `aseguradora` VALUES (64, 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION CENTRO \"AFOCAT REGION CENTRO\"', 2, 1);
INSERT INTO `aseguradora` VALUES (65, 'AFOCAT EL ALTIPLANO', 2, 1);
INSERT INTO `aseguradora` VALUES (66, 'AFOCAT CONFIANZA (ANTES AUTOSEGUROS DE FONDOS CONTRA ACCIDENTES DETRANSITO DE LIMA)', 2, 1);
INSERT INTO `aseguradora` VALUES (67, 'PRUEBA', 1, 0);

-- ----------------------------
-- Table structure for categoria_vehicular
-- ----------------------------
DROP TABLE IF EXISTS `categoria_vehicular`;
CREATE TABLE `categoria_vehicular`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categoria_vehicular_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria_vehicular
-- ----------------------------
INSERT INTO `categoria_vehicular` VALUES (31, 1, 'M1', 1);
INSERT INTO `categoria_vehicular` VALUES (32, 2, 'M2', 1);
INSERT INTO `categoria_vehicular` VALUES (33, 3, 'M3', 1);
INSERT INTO `categoria_vehicular` VALUES (34, 4, 'N1', 1);
INSERT INTO `categoria_vehicular` VALUES (35, 5, 'N2', 1);
INSERT INTO `categoria_vehicular` VALUES (36, 6, 'N3', 1);
INSERT INTO `categoria_vehicular` VALUES (37, 7, 'O1', 1);
INSERT INTO `categoria_vehicular` VALUES (38, 8, 'O2', 1);
INSERT INTO `categoria_vehicular` VALUES (39, 9, 'O3', 1);
INSERT INTO `categoria_vehicular` VALUES (40, 10, 'O4', 1);
INSERT INTO `categoria_vehicular` VALUES (41, 11, 'L1', 1);
INSERT INTO `categoria_vehicular` VALUES (42, 12, 'L2', 1);
INSERT INTO `categoria_vehicular` VALUES (43, 13, 'L3', 1);
INSERT INTO `categoria_vehicular` VALUES (44, 14, 'L4', 1);
INSERT INTO `categoria_vehicular` VALUES (45, 15, 'L5', 1);

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_documento_id` int(11) NOT NULL,
  `numero_documento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Para RUC sera la razon social',
  `apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `whatsapp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `cliente_numero_documento_unique`(`numero_documento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 1, '46397067', 'KEVIN', 'BAYLON', 'kbaylonh@outlook.com', '987217324', NULL, 1, '2024-09-25 20:44:58', '2024-11-09 09:14:51');
INSERT INTO `cliente` VALUES (2, 1, '07452544', 'K2', 'K2', 'sas', 'asa', NULL, 0, '2024-09-26 02:04:00', '2024-11-12 13:23:29');
INSERT INTO `cliente` VALUES (3, 1, '46742400', 'ERIKA', 'MUCHICA', 'emuchica@gmail.com', '941071056', NULL, 1, '2024-10-19 17:52:24', '2024-10-28 21:58:57');
INSERT INTO `cliente` VALUES (4, 1, '45350382', 'Jorge', 'Salcedo', 'jorgeshevchenk@gmail.com', '944674630', NULL, 1, '2024-11-09 09:13:26', '2024-11-09 09:39:27');

-- ----------------------------
-- Table structure for ficha_vehiculo
-- ----------------------------
DROP TABLE IF EXISTS `ficha_vehiculo`;
CREATE TABLE `ficha_vehiculo`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint(20) NOT NULL,
  `cliente2_id` bigint(20) NOT NULL,
  `sucursal_id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `CIOD_CITV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Codigo de inicio de operacion diaria',
  `PLACA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Placa del vehiculo',
  `CATEGORIA` int(11) NOT NULL DEFAULT 0,
  `TIPSERVICIO` int(11) NOT NULL DEFAULT 0,
  `TIPAMBITO` int(11) NOT NULL DEFAULT 0,
  `TIPINSPECCION` int(11) NOT NULL DEFAULT 0,
  `NUM_FICHA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CATEGORIA_DESC` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MARCA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MODELO` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ANOFAB` int(11) NOT NULL,
  `COMBUSTIBLE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `VINSERCHA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NUMEROMOTOR` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CARROCERIA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NUMEROEJES` int(11) NOT NULL,
  `NUMERORUEDAS` int(11) NOT NULL,
  `NUMEROASIENTOS` int(11) NOT NULL,
  `NUMEROPASAJEROS` int(11) NOT NULL,
  `LARGO` decimal(8, 2) NOT NULL,
  `ANCHO` decimal(8, 2) NOT NULL,
  `ALTO` decimal(8, 2) NOT NULL,
  `COLOR` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PESONETO` decimal(8, 2) NOT NULL,
  `PESOBRUTO` decimal(8, 2) NOT NULL,
  `PESOUTIL` decimal(8, 2) NOT NULL,
  `NUMDOC_ULTREV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FECDOC_ULTREV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `RAZSOCCITV_ULTREV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `OBS_ULTREV` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `TIPPOLIZA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ASEGURADORA` bigint(20) NULL DEFAULT NULL,
  `NUMPOLIZA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FECINIPOLIZA` date NULL DEFAULT NULL,
  `FECFINPOLIZA` date NULL DEFAULT NULL,
  `MENSAJE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ficha_vehiculo
-- ----------------------------
INSERT INTO `ficha_vehiculo` VALUES (1, 0, 0, 1, 2, 'CITV00001', 'B26963', 1, 1, 1, 1, 'F87707213', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-02 20:23:00', '2024-10-02 20:23:00');
INSERT INTO `ficha_vehiculo` VALUES (2, 0, 0, 1, 2, 'CITV00001', 'B26963', 1, 1, 1, 1, 'F66108525', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', NULL, 'ADSWASDASDASD', '2024-10-02', '2024-11-02', NULL, '2024-10-02 20:57:06', '2024-10-02 20:57:30');
INSERT INTO `ficha_vehiculo` VALUES (3, 0, 0, 1, 2, 'CITV00001', 'B26963', 1, 1, 1, 1, 'F22548496', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', NULL, 'ASDQASDASD45645646', '2024-10-02', '2024-11-02', NULL, '2024-10-02 20:57:45', '2024-10-02 20:58:02');
INSERT INTO `ficha_vehiculo` VALUES (4, 0, 0, 1, 2, 'CITV00001', 'B26963', 1, 1, 1, 1, 'F50201276', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', NULL, 'wqwasdlñaskdlñkaslñdk', '2024-10-02', '2024-11-02', NULL, '2024-10-02 20:58:49', '2024-10-02 20:59:01');
INSERT INTO `ficha_vehiculo` VALUES (5, 0, 0, 1, 2, 'CITV00001', 'B26963', 1, 1, 1, 1, 'F12753674', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', NULL, 'LJSAKDLJKLSAJDLJ', '2024-10-02', '2024-11-02', NULL, '2024-10-02 21:13:44', '2024-10-02 21:16:16');
INSERT INTO `ficha_vehiculo` VALUES (6, 0, 0, 1, 2, 'CITV18779818', 'B26963', 1, 1, 1, 4, 'F70889114', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-27 18:23:57', '2024-10-27 18:23:57');
INSERT INTO `ficha_vehiculo` VALUES (7, 0, 0, 1, 2, 'CITV18779818', 'B26963', 3, 1, 1, 4, 'F67106677', 'M3', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-27 18:39:32', '2024-10-27 18:39:32');
INSERT INTO `ficha_vehiculo` VALUES (8, 0, 0, 1, 2, 'CITV18779818', 'B26963', 2, 2, 2, 3, 'F88089501', 'M2', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-27 18:44:27', '2024-10-27 18:44:27');
INSERT INTO `ficha_vehiculo` VALUES (9, 0, 0, 1, 2, 'CITV18779818', 'B26963', 2, 1, 1, 2, 'F90677381', 'M2', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-27 18:53:27', '2024-10-27 18:53:27');
INSERT INTO `ficha_vehiculo` VALUES (10, 0, 0, 1, 2, 'CITV18779818', 'B26963', 2, 1, 1, 2, 'F58330758', 'M2', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', NULL, '', NULL, NULL, NULL, '2024-10-27 18:54:35', '2024-10-27 18:54:35');
INSERT INTO `ficha_vehiculo` VALUES (11, 0, 0, 1, 2, 'CITV18779818', 'B26963', 2, 1, 1, 3, 'F73857356', 'M2', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', 0, '', NULL, NULL, NULL, '2024-10-27 20:01:27', '2024-10-27 20:01:27');
INSERT INTO `ficha_vehiculo` VALUES (12, 0, 0, 1, 2, 'CITV18779818', 'B26963', 2, 1, 1, 2, 'F88522392', 'M2', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '', 0, '', NULL, NULL, NULL, '2024-10-27 20:02:04', '2024-10-27 20:02:04');
INSERT INTO `ficha_vehiculo` VALUES (13, 0, 0, 1, 2, 'CITV18779818', 'B26963', 1, 1, 1, 2, 'F87499534', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', 0, 'asdasdasdasd', '2024-10-27', '2024-10-28', NULL, '2024-10-27 20:03:24', '2024-10-27 20:03:33');
INSERT INTO `ficha_vehiculo` VALUES (14, 0, 0, 1, 1, 'CITV21566236', 'B26963', 1, 1, 5, 1, 'F22034476', 'M1', 'HYUNDAY', 'COUNTY', 2010, 'DIESEL', 'VIN123456', 'MOTOR123456', 'BUS', 2, 4, 32, 30, 10.50, 2.50, 3.50, 'BLANCO', 1000.00, 2000.00, 1500.00, '', '', '', '', '1', 0, '123312', '2024-12-01', '2024-12-16', NULL, '2024-12-16 11:36:49', '2024-12-16 11:42:46');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icono` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `padre_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Sistema', '#', 'ri-settings-2-line', 0, 8, 1, '2024-10-02 17:15:31', '2024-10-02 21:20:51');
INSERT INTO `menu` VALUES (2, 'Clientes', '/clientes', 'ri-user-line', 0, 4, 1, '2024-10-02 18:28:25', '2024-10-02 20:27:31');
INSERT INTO `menu` VALUES (3, 'Usuarios', '/usuarios', 'ri-id-card-line', 0, 5, 1, '2024-10-02 18:36:49', '2024-10-02 20:27:37');
INSERT INTO `menu` VALUES (4, 'Roles', '/mantenimiento/roles', NULL, 1, 1, 1, '2024-10-02 20:36:21', '2024-10-02 20:36:21');
INSERT INTO `menu` VALUES (5, 'Menus', '/mantenimiento/menus', NULL, 1, 2, 1, '2024-10-02 20:36:35', '2024-10-02 20:36:35');
INSERT INTO `menu` VALUES (11, 'Sucursales', '/sucursales', 'ri-building-2-line', 0, 6, 1, '2024-10-02 21:20:20', '2024-10-02 21:20:46');
INSERT INTO `menu` VALUES (37, 'Aseguradoras', '/mantenimiento/aseguradoras', NULL, 42, 1, 1, '2024-12-16 10:38:08', NULL);
INSERT INTO `menu` VALUES (38, 'Categorias Vehiculares', '/mantenimiento/categorias-vehiculares', NULL, 42, 2, 1, '2024-12-16 10:39:02', NULL);
INSERT INTO `menu` VALUES (39, 'Tipos Ambitos', '/mantenimiento/tipos-ambitos', NULL, 42, 3, 1, '2024-12-16 10:39:43', NULL);
INSERT INTO `menu` VALUES (40, 'Tipos Inspecciones', '/mantenimiento/tipos-inspecciones', NULL, 42, 4, 1, '2024-12-16 10:39:43', NULL);
INSERT INTO `menu` VALUES (41, 'Tipos Servicios', '/mantenimiento/tipos-servicios', NULL, 42, 5, 1, '2024-12-16 10:39:43', NULL);
INSERT INTO `menu` VALUES (42, 'Matenimientos', '#', 'ri-car-line', 0, 7, 1, '2024-12-16 11:00:39', NULL);
INSERT INTO `menu` VALUES (43, 'Ingreso Counter', '/ingreso-counter', 'ri-edit-line', 0, 1, 1, '2024-12-16 10:39:43', NULL);
INSERT INTO `menu` VALUES (44, 'Operaciones Diarias', '/operaciones-diarias', 'ri-edit-line', 0, 2, 1, '2024-12-16 10:39:43', NULL);
INSERT INTO `menu` VALUES (45, 'Nueva Ficha', '/nueva-ficha', 'ri-save-line', 0, 3, 1, '2024-12-16 11:21:29', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (53, '2024_09_12_041333_create_tipo_servicio_table', 1);
INSERT INTO `migrations` VALUES (54, '2024_09_12_042147_create_tipo_ambito_table', 1);
INSERT INTO `migrations` VALUES (55, '2024_09_12_042909_create_tipo_inspeccion_table', 1);
INSERT INTO `migrations` VALUES (56, '2024_09_12_043140_create_categoria_vehicular_table', 1);
INSERT INTO `migrations` VALUES (57, '2024_09_20_061432_create_usuario_table', 1);
INSERT INTO `migrations` VALUES (58, '2024_09_20_062122_create_cliente_table', 1);
INSERT INTO `migrations` VALUES (59, '2024_09_20_062407_create_sucursal_table', 1);
INSERT INTO `migrations` VALUES (60, '2024_09_24_170631_create_tipo_poliza_table', 1);
INSERT INTO `migrations` VALUES (61, '2024_09_24_170636_create_aseguradora_table', 1);
INSERT INTO `migrations` VALUES (62, '2024_09_24_171305_create_motivo_anulacion_table', 1);
INSERT INTO `migrations` VALUES (65, '2024_09_25_202625_create_tipo_documento_table', 3);
INSERT INTO `migrations` VALUES (66, '2024_10_02_044955_create_rol_table', 4);
INSERT INTO `migrations` VALUES (67, '2024_10_02_044959_create_rol_menu_table', 4);
INSERT INTO `migrations` VALUES (68, '2024_10_02_045002_create_menu_table', 4);
INSERT INTO `migrations` VALUES (69, '2024_10_02_045100_update_usuario_table', 4);
INSERT INTO `migrations` VALUES (70, '2024_09_24_204307_create_operacion_diaria_table', 5);
INSERT INTO `migrations` VALUES (72, '2024_09_24_205133_create_ficha_vehiculo_table', 6);
INSERT INTO `migrations` VALUES (73, '2024_10_15_225644_create_personal_access_tokens_table', 7);

-- ----------------------------
-- Table structure for motivo_anulacion
-- ----------------------------
DROP TABLE IF EXISTS `motivo_anulacion`;
CREATE TABLE `motivo_anulacion`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `motivo_anulacion_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of motivo_anulacion
-- ----------------------------
INSERT INTO `motivo_anulacion` VALUES (11, 1, 'Error digitación u Omisión', 1);
INSERT INTO `motivo_anulacion` VALUES (12, 2, 'Error de impresión de documento', 1);
INSERT INTO `motivo_anulacion` VALUES (13, 3, 'Error de Operación', 1);
INSERT INTO `motivo_anulacion` VALUES (14, 4, 'Pérdida o Robo', 1);
INSERT INTO `motivo_anulacion` VALUES (15, 5, 'Deterioro', 1);

-- ----------------------------
-- Table structure for operacion_diaria
-- ----------------------------
DROP TABLE IF EXISTS `operacion_diaria`;
CREATE TABLE `operacion_diaria`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de inicio de operación diaria',
  `hora_inicio` time(0) NOT NULL,
  `hora_fin` time(0) NULL DEFAULT NULL,
  `CODENTIDA` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código de la entidad',
  `CODLOCAL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código del local',
  `CODIV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Codigo identificador de validacion por el MTC',
  `CIOD_CITV` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Codigo de inicio de operacion diaria',
  `MENSAJE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Mensaje de respuesta del web service',
  `NUMTRADIA` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de transacciones exitosas realizadas en el día',
  `NUMCERTI` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de certificados generados',
  `NUMINFOR` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de informes generados',
  `NUMANUL` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de anulaciones realizadas',
  `ucierre` int(11) NOT NULL DEFAULT 0 COMMENT 'Indica en timestamp la fecha y hora de cierre de la operación diaria',
  `estado` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Estado de la operación diaria',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of operacion_diaria
-- ----------------------------
INSERT INTO `operacion_diaria` VALUES (1, 1, '2024-10-02', '22:19:39', NULL, 'E00000001', 'E00001', 'XYL54ENGMKA49FG21', 'CITV00001', NULL, 0, 0, 0, 0, 0, 1, '2024-10-02 22:19:39', '2024-10-02 22:19:39');
INSERT INTO `operacion_diaria` VALUES (2, 2, '2024-10-02', '22:35:08', NULL, 'E00000001', 'E00002', 'XYL54ENGMKA49FG21', 'CITV00001', NULL, 0, 0, 0, 0, 0, 1, '2024-10-02 22:35:08', '2024-10-02 22:35:08');
INSERT INTO `operacion_diaria` VALUES (3, 3, '2024-10-02', '22:35:45', NULL, 'E00000001', 'E00003', 'XYL54ENGMKA49FG21', 'CITV18279106', NULL, 0, 0, 0, 0, 0, 1, '2024-10-02 22:35:45', '2024-10-02 22:35:45');
INSERT INTO `operacion_diaria` VALUES (4, 1, '2024-10-27', '12:20:03', NULL, 'E00000001', 'E00001', 'XYL54ENGMKA49FG21', 'CITV18779818', NULL, 0, 0, 0, 0, 0, 1, '2024-10-27 12:20:03', '2024-10-27 12:20:03');
INSERT INTO `operacion_diaria` VALUES (5, 3, '2024-11-07', '23:28:52', NULL, 'E00000001', 'E00003', 'XYL54ENGMKA49FG21', 'CITV70281340', NULL, 0, 0, 0, 0, 0, 1, '2024-11-07 23:28:52', '2024-11-07 23:28:52');
INSERT INTO `operacion_diaria` VALUES (6, 1, '2024-12-16', '11:19:46', NULL, 'E00000001', 'E00001', 'XYL54ENGMKA49FG21', 'CITV21566236', NULL, 0, 0, 0, 0, 0, 1, '2024-12-16 11:19:46', '2024-12-16 11:19:46');
INSERT INTO `operacion_diaria` VALUES (7, 2, '2024-12-16', '11:32:50', NULL, 'E00000001', 'E00002', 'XYL54ENGMKA49FG21', 'CITV32827787', NULL, 0, 0, 0, 0, 0, 1, '2024-12-16 11:32:50', '2024-12-16 11:32:50');
INSERT INTO `operacion_diaria` VALUES (8, 3, '2024-12-16', '11:33:03', NULL, 'E00000001', 'E00003', 'XYL54ENGMKA49FG21', 'CITV57976446', NULL, 0, 0, 0, 0, 0, 1, '2024-12-16 11:33:03', '2024-12-16 11:33:03');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (1, 'App\\Models\\Usuario', 1, 'auth_token', '10c5a204af7a583682fc0c4500bb8fe22387ae733740c9f0a7243fff653c15da', '[\"*\"]', '2024-10-28 23:41:31', NULL, '2024-10-28 21:39:00', '2024-10-28 23:41:31');
INSERT INTO `personal_access_tokens` VALUES (2, 'App\\Models\\Usuario', 1, 'auth_token', 'df997dc90849afb2156933a3bd046a7601696d627dbb1dd588b746ba35087cb2', '[\"*\"]', '2024-11-08 00:11:20', NULL, '2024-11-07 23:27:31', '2024-11-08 00:11:20');
INSERT INTO `personal_access_tokens` VALUES (3, 'App\\Models\\Usuario', 2, 'auth_token', '451276160e7c3d71912f82cb11e2b59f1a264bb5fac36d410a36e2360846d3a1', '[\"*\"]', '2024-11-07 23:51:29', NULL, '2024-11-07 23:31:23', '2024-11-07 23:51:29');
INSERT INTO `personal_access_tokens` VALUES (4, 'App\\Models\\Usuario', 1, 'auth_token', 'fd8b2a11bc5c2e130b4fc549e29d42329af4f63b0878f8d1e61c5a86041a77f3', '[\"*\"]', '2024-11-09 11:18:29', NULL, '2024-11-09 01:08:11', '2024-11-09 11:18:29');
INSERT INTO `personal_access_tokens` VALUES (5, 'App\\Models\\Usuario', 1, 'auth_token', '10da72a5ec08676fa056ea2d48023e2975ee9d7c489d34cb0ea6ad04d5d6e469', '[\"*\"]', '2024-11-09 11:23:52', NULL, '2024-11-09 11:11:39', '2024-11-09 11:23:52');
INSERT INTO `personal_access_tokens` VALUES (6, 'App\\Models\\Usuario', 1, 'auth_token', '8a266feeeec5c8bc4694dbb2a11553a1ba62b1d2213dd54e72e4487b10737338', '[\"*\"]', '2024-11-10 18:19:30', NULL, '2024-11-10 18:19:27', '2024-11-10 18:19:30');
INSERT INTO `personal_access_tokens` VALUES (7, 'App\\Models\\Usuario', 1, 'auth_token', '3a6a3363fe22a4ad021cfc210e02765a4f4a4335627efd9824e94d49edf155d4', '[\"*\"]', '2024-11-11 17:51:13', NULL, '2024-11-11 17:49:32', '2024-11-11 17:51:13');
INSERT INTO `personal_access_tokens` VALUES (8, 'App\\Models\\Usuario', 1, 'auth_token', 'ecbeae7e23c43bb761cae1a1e1738b9066e71ab3675198bc7d055466fb72877b', '[\"*\"]', '2024-11-12 19:41:19', NULL, '2024-11-12 12:27:16', '2024-11-12 19:41:19');
INSERT INTO `personal_access_tokens` VALUES (9, 'App\\Models\\Usuario', 1, 'auth_token', 'f2cb55f291e10cda36e4a3d20a56045d04b4da22c6005a1eda8c75fbb11154aa', '[\"*\"]', '2024-11-12 22:19:27', NULL, '2024-11-12 21:59:06', '2024-11-12 22:19:27');
INSERT INTO `personal_access_tokens` VALUES (10, 'App\\Models\\Usuario', 1, 'auth_token', '3e803868f333c3746a0b8d5ded3745890bb078704a8176ce961741b6ec0ad5f6', '[\"*\"]', '2024-11-12 23:36:58', NULL, '2024-11-12 23:36:25', '2024-11-12 23:36:58');
INSERT INTO `personal_access_tokens` VALUES (11, 'App\\Models\\Usuario', 1, 'auth_token', '19f984a3274261a07e4ad56194d63e65de2fb71db06beec37caec6c6a073f6a0', '[\"*\"]', '2024-11-13 01:11:39', NULL, '2024-11-13 01:09:05', '2024-11-13 01:11:39');
INSERT INTO `personal_access_tokens` VALUES (12, 'App\\Models\\Usuario', 1, 'auth_token', '3992e426516517aee0c30da9574f3844ad1d33e5c8d3ce70ab308b4bcb98cb61', '[\"*\"]', '2024-11-13 01:13:01', NULL, '2024-11-13 01:12:54', '2024-11-13 01:13:01');
INSERT INTO `personal_access_tokens` VALUES (13, 'App\\Models\\Usuario', 1, 'auth_token', '88525d198931007948b4f6851e95376d09beec64b419d8659afa19e37d8c5a08', '[\"*\"]', '2024-11-13 01:15:40', NULL, '2024-11-13 01:15:40', '2024-11-13 01:15:40');
INSERT INTO `personal_access_tokens` VALUES (14, 'App\\Models\\Usuario', 1, 'auth_token', '994567c75ca0c92a3153cd378e055ea476c7e064c96015dee0d21c793ae042c4', '[\"*\"]', '2024-11-13 01:20:50', NULL, '2024-11-13 01:20:49', '2024-11-13 01:20:50');
INSERT INTO `personal_access_tokens` VALUES (15, 'App\\Models\\Usuario', 1, 'auth_token', '3f6f4f565bf9363c84a25cd22fa44b242dba1bc3c2e28e1288cc7de436c684b3', '[\"*\"]', '2024-11-13 01:21:06', NULL, '2024-11-13 01:21:01', '2024-11-13 01:21:06');
INSERT INTO `personal_access_tokens` VALUES (16, 'App\\Models\\Usuario', 1, 'auth_token', '3417334fe8241d9def5a8645919ac41ba3a19cb4f6c3860bc8931be24a0b5e55', '[\"*\"]', '2024-11-13 01:21:13', NULL, '2024-11-13 01:21:13', '2024-11-13 01:21:13');
INSERT INTO `personal_access_tokens` VALUES (17, 'App\\Models\\Usuario', 1, 'auth_token', 'c5ee81ab4f91a9dc19889ff54e7d86e2ff679585196e4c3c1b0d3afed9a11b95', '[\"*\"]', '2024-11-13 01:34:02', NULL, '2024-11-13 01:34:01', '2024-11-13 01:34:02');
INSERT INTO `personal_access_tokens` VALUES (18, 'App\\Models\\Usuario', 1, 'auth_token', '49d2b7d2b410582ffde5f9eddb074ff419f279781c972372eed7bd90fbd3f5da', '[\"*\"]', '2024-11-13 01:35:30', NULL, '2024-11-13 01:35:29', '2024-11-13 01:35:30');
INSERT INTO `personal_access_tokens` VALUES (19, 'App\\Models\\Usuario', 1, 'auth_token', '8242f6d17fecb6c63df042ef26a919435fb4ea0e36b9b9fc014fc8ac24e75a4f', '[\"*\"]', '2024-11-13 02:01:06', NULL, '2024-11-13 02:01:04', '2024-11-13 02:01:06');
INSERT INTO `personal_access_tokens` VALUES (20, 'App\\Models\\Usuario', 1, 'auth_token', 'db28b46e059602f66d43a1bfd7ccdd8f6c508e4cc24b679e0ba2198a11da227a', '[\"*\"]', '2024-11-13 02:06:50', NULL, '2024-11-13 02:06:48', '2024-11-13 02:06:50');
INSERT INTO `personal_access_tokens` VALUES (21, 'App\\Models\\Usuario', 1, 'auth_token', '5c8b9c248e4094ea7f74c8a530c59638cb2cdf9106d901b7f47b7859b18f7e90', '[\"*\"]', '2024-12-16 11:47:15', NULL, '2024-12-16 10:32:25', '2024-12-16 11:47:15');
INSERT INTO `personal_access_tokens` VALUES (22, 'App\\Models\\Usuario', 2, 'auth_token', '25defa5cd7f5b8497e421abfb9093bb9fbdd18535cdff29b9baea9959d324bce', '[\"*\"]', '2024-12-16 11:21:40', NULL, '2024-12-16 10:35:25', '2024-12-16 11:21:40');

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'Operador', 1, '2024-10-02 05:38:50', '2024-11-12 23:36:57');
INSERT INTO `rol` VALUES (2, 'Administrador', 1, '2024-10-02 19:47:04', '2024-11-12 22:19:27');
INSERT INTO `rol` VALUES (3, 'SubAdministrador', 1, '2024-10-02 20:19:46', '2024-10-02 20:19:46');
INSERT INTO `rol` VALUES (4, 'Cajero 2', 1, '2024-10-27 07:25:26', '2024-10-27 07:26:34');

-- ----------------------------
-- Table structure for rol_menu
-- ----------------------------
DROP TABLE IF EXISTS `rol_menu`;
CREATE TABLE `rol_menu`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol_menu
-- ----------------------------
INSERT INTO `rol_menu` VALUES (2, 2, 2, NULL, NULL);
INSERT INTO `rol_menu` VALUES (3, 2, 3, NULL, NULL);
INSERT INTO `rol_menu` VALUES (4, 2, 1, NULL, NULL);
INSERT INTO `rol_menu` VALUES (5, 3, 2, NULL, NULL);
INSERT INTO `rol_menu` VALUES (6, 3, 3, NULL, NULL);
INSERT INTO `rol_menu` VALUES (7, 2, 11, NULL, NULL);
INSERT INTO `rol_menu` VALUES (10, 1, 13, NULL, NULL);
INSERT INTO `rol_menu` VALUES (11, 1, 2, NULL, NULL);
INSERT INTO `rol_menu` VALUES (12, 2, 12, NULL, NULL);
INSERT INTO `rol_menu` VALUES (13, 4, 2, NULL, NULL);
INSERT INTO `rol_menu` VALUES (15, 2, 42, NULL, NULL);
INSERT INTO `rol_menu` VALUES (16, 2, 43, NULL, NULL);
INSERT INTO `rol_menu` VALUES (18, 2, 44, NULL, NULL);
INSERT INTO `rol_menu` VALUES (19, 2, 45, NULL, NULL);

-- ----------------------------
-- Table structure for sucursal
-- ----------------------------
DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE `sucursal`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo_local` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sucursal
-- ----------------------------
INSERT INTO `sucursal` VALUES (1, 'E00001', 'Principal', 'Av. Principal 6667', NULL, NULL, 1, '2024-10-02 21:13:28', '2024-10-23 21:08:20');
INSERT INTO `sucursal` VALUES (2, 'E00002', 'Lima Norte', 'Lima Norte', NULL, NULL, 1, '2024-10-02 21:17:39', '2024-10-02 21:17:39');
INSERT INTO `sucursal` VALUES (3, 'E00003', 'Lima Sur', 'Lima Sur', NULL, NULL, 1, '2024-10-02 21:19:11', '2024-10-23 21:10:17');

-- ----------------------------
-- Table structure for tipo_ambito
-- ----------------------------
DROP TABLE IF EXISTS `tipo_ambito`;
CREATE TABLE `tipo_ambito`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tipo_ambito_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_ambito
-- ----------------------------
INSERT INTO `tipo_ambito` VALUES (13, 0, 'Ninguno', 1);
INSERT INTO `tipo_ambito` VALUES (14, 1, 'Ambito Nacional', 1);
INSERT INTO `tipo_ambito` VALUES (15, 2, 'Ambito Regional', 1);
INSERT INTO `tipo_ambito` VALUES (16, 3, 'Ambito Provincial', 1);
INSERT INTO `tipo_ambito` VALUES (17, 4, 'Ambito Internacional (Pasajeros)', 1);
INSERT INTO `tipo_ambito` VALUES (18, 5, 'Ambito Distrital', 1);

-- ----------------------------
-- Table structure for tipo_documento
-- ----------------------------
DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE `tipo_documento`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_documento
-- ----------------------------
INSERT INTO `tipo_documento` VALUES (1, 'DNI');
INSERT INTO `tipo_documento` VALUES (4, 'C.E.');
INSERT INTO `tipo_documento` VALUES (6, 'RUC');
INSERT INTO `tipo_documento` VALUES (7, 'Pasaporte');

-- ----------------------------
-- Table structure for tipo_inspeccion
-- ----------------------------
DROP TABLE IF EXISTS `tipo_inspeccion`;
CREATE TABLE `tipo_inspeccion`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tipo_inspeccion_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_inspeccion
-- ----------------------------
INSERT INTO `tipo_inspeccion` VALUES (11, 1, 'Ordinaria', 1);
INSERT INTO `tipo_inspeccion` VALUES (12, 2, 'Ordinaria y complementaria', 1);
INSERT INTO `tipo_inspeccion` VALUES (13, 3, 'Extraordinaria', 1);
INSERT INTO `tipo_inspeccion` VALUES (14, 4, 'Incorporación', 1);
INSERT INTO `tipo_inspeccion` VALUES (15, 5, 'Complementaria', 1);

-- ----------------------------
-- Table structure for tipo_poliza
-- ----------------------------
DROP TABLE IF EXISTS `tipo_poliza`;
CREATE TABLE `tipo_poliza`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tipo_poliza_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_poliza
-- ----------------------------
INSERT INTO `tipo_poliza` VALUES (1, 'SOAT', 'Seguro Obligatorio de Accidentes de Tránsito', 1);
INSERT INTO `tipo_poliza` VALUES (2, 'AFOCAT', 'Asociaciones de Fondos Regionales o Provinciales contra Accidentes de Tránsito', 1);

-- ----------------------------
-- Table structure for tipo_servicio
-- ----------------------------
DROP TABLE IF EXISTS `tipo_servicio`;
CREATE TABLE `tipo_servicio`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tipo_servicio_codigo_unique`(`codigo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_servicio
-- ----------------------------
INSERT INTO `tipo_servicio` VALUES (49, 0, 'Ninguno', 1);
INSERT INTO `tipo_servicio` VALUES (50, 1, 'Transporte Regular de Personas', 1);
INSERT INTO `tipo_servicio` VALUES (51, 2, 'Transporte Privado de Personas', 1);
INSERT INTO `tipo_servicio` VALUES (52, 3, 'Transporte Especial de Personas - Turístico', 1);
INSERT INTO `tipo_servicio` VALUES (53, 4, 'Transporte Especial de Personas - Trabajadores', 1);
INSERT INTO `tipo_servicio` VALUES (54, 5, 'Transporte Especial de Personas - Estudiantes', 1);
INSERT INTO `tipo_servicio` VALUES (55, 6, 'Transporte Especial de Personas - Social', 1);
INSERT INTO `tipo_servicio` VALUES (56, 7, 'Transporte Especial de Personas - Auto Colectivo', 1);
INSERT INTO `tipo_servicio` VALUES (57, 8, 'Transporte Especial de Personas - Taxi', 1);
INSERT INTO `tipo_servicio` VALUES (58, 9, 'Transporte de Mercancías en General Público', 1);
INSERT INTO `tipo_servicio` VALUES (59, 10, 'Transporte de Mercancías Privado', 1);
INSERT INTO `tipo_servicio` VALUES (60, 11, 'Transporte de Materiales y Residuos Peligrosos', 1);
INSERT INTO `tipo_servicio` VALUES (61, 12, 'Servicio Especial Comunal de Transporte de Pasajeros por Carretera', 1);
INSERT INTO `tipo_servicio` VALUES (62, 13, 'Servicio de Transporte Publico Especial de Pasajeros de Pasajeros en Vehículos Menores.', 1);
INSERT INTO `tipo_servicio` VALUES (63, 14, 'Servicio de Transporte Mixto.', 1);
INSERT INTO `tipo_servicio` VALUES (64, 15, 'Servicio de Transporte Internacional de Pasajeros por Carretera de la Comunidad Andina.', 1);
INSERT INTO `tipo_servicio` VALUES (65, 16, 'Servicio de Transporte Internacional de Mercancías por Carretera de la Comunidad Andina.', 1);
INSERT INTO `tipo_servicio` VALUES (66, 17, 'Servicio de Transporte de Pasajeros por Carretera entre Tacna – Arica.', 1);
INSERT INTO `tipo_servicio` VALUES (67, 18, 'Servicio de Transporte Transfronterizo de Pasajeros en Ómnibus Entre Perú – Ecuador.', 1);
INSERT INTO `tipo_servicio` VALUES (68, 19, 'Servicio de Transporte Transfronterizo de Pasajeros en Taxi Entre Perú – Ecuador.', 1);
INSERT INTO `tipo_servicio` VALUES (69, 20, 'Servicio de Transporte Transfronterizo Turístico entre Perú – Ecuador.', 1);
INSERT INTO `tipo_servicio` VALUES (70, 21, 'Servicio de Transporte Transfronterizo de Mercancías entre Perú – Ecuador.', 1);
INSERT INTO `tipo_servicio` VALUES (71, 22, 'Servicio de Transporte Internacional Terrestre de Pasajeros por Carretera - ATIT (Cono Sur).', 1);
INSERT INTO `tipo_servicio` VALUES (72, 23, 'Servicio de Transporte Internacional Terrestre de Mercancías por Carretera - ATIT (Cono Sur).', 1);
INSERT INTO `tipo_servicio` VALUES (73, 999, 'PRUEBA', 0);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rol_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `sucursal_id` bigint(20) NOT NULL DEFAULT 0,
  `nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `dni` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `usuario_dni_unique`(`dni`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 2, 1, 'Administrador', 'General', NULL, NULL, '00000000', '$2y$12$way1LOAfm9STVv3QFQzXUOAw/dOh1wNfqFVUh0F997TEOsHXfDIJi', 'L7XYXHXa2i1Pw6L7zAfyOfm7Z0otuqUbrAkaL8CIInC1qy9N9N33jl1WWsQb', NULL, 1, NULL, '2024-10-02 21:28:15');
INSERT INTO `usuario` VALUES (2, 1, 1, 'Operador', '1', NULL, NULL, '00000001', '$2y$12$j/zQ2zayN.elqc9qWjCSL.Gc0IQJsSmEcyXbB0QOmUTdUY0qvSSRu', 'hotLG88xPFL49Fq4ZvbZSPTWWYthGu4jWiGZ6sh2Mv5Az9REK8HAJkLoObdZ', NULL, 1, '2024-10-02 22:43:47', '2024-10-23 23:50:57');

SET FOREIGN_KEY_CHECKS = 1;
