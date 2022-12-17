-- Tabla maestra 'cat_ciudadano_cabms' debe haber sido cargada previamente (ver seeder ) --

-- Llenar cat_sectores --

INSERT INTO cat_sectores(sector, created_at, updated_at) SELECT DISTINCT(sector), current_timestamp, current_timestamp FROM cat_ciudadano_cabms;

-- Llenar cat_categorias_scian --

INSERT INTO cat_categorias_scian(categoria_scian, scian, palabras_clave_afines, id_sector, created_at, updated_at)
SELECT distinct(giro), scian, palabras_clave_afines, cs.id as id_sector, current_timestamp, current_timestamp
FROM cat_ciudadano_cabms as ccc
         INNER JOIN cat_sectores AS cs ON cs.sector = ccc.sector
ORDER BY giro;

-- Llenar cat_cabms --

INSERT INTO cat_cabms(cabms, nombre_cabms, partida, id_categoria_scian, created_at, updated_at)
SELECT cabms, nombre_cabms, partida, ccs.id as id_categoria_scian, current_timestamp, current_timestamp FROM cat_ciudadano_cabms
        INNER JOIN cat_categorias_scian ccs on cat_ciudadano_cabms.giro = ccs.categoria_scian
ORDER BY nombre_cabms;
