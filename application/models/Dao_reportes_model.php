<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_reportes_model extends CI_Model {

  public function getNemonicosAccordingDate($fi,$ff)
  {
    $this->db->where('(DESCRIPTION LIKE "%FAOC:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FAOB:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FAPP:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FEE:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FI:%"');
    $this->db->or_where('DESCRIPTION LIKE "%FOIP:%")');
    $this->db->where("DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'");
    $this->db->order_by('DESCRIPTION','DESC');
    $query = $this->db->get('maximo.INCIDENT');
    // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
    // echo '<pre>'; print_r("======================"); echo '</pre>';
    return $query->result();
    // echo '<pre>'; print_r($query->result()); echo '</pre>';
  }
  
  //Retorna el nombre del trabajo, el subestado, y los puntos de acuerdo al id de las tablas puntos, tipo_trabajo y subestado --jc
    public function getInfoReportSlas($fdesde,$fhasta){
        $query = $this->db->query("
            SELECT 
                (CASE WHEN DESCRIPTION LIKE '%FAOC%' THEN 'FAOC'
                    WHEN DESCRIPTION LIKE '%FAOB%' THEN 'FAOB'
                    WHEN DESCRIPTION LIKE '%FAPP%' THEN 'FAPP'
                    WHEN DESCRIPTION LIKE '%FEE%' THEN 'FEE'
                    WHEN DESCRIPTION LIKE '%FI%' THEN 'FI'
                    WHEN DESCRIPTION LIKE '%FOIP%' THEN 'FOIP'
                    ELSE 'Sin coordinación'
                END) AS coordinacion,
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 1 AND TIEMPO_ESCALA <= 20, 1, 0)) AS 'alta_alta_20_min',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 1 AND TIEMPO_ESCALA > 20, 1, 0)) AS 'alta_alta_20_max',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 2 AND TIEMPO_ESCALA <= 40, 1, 0)) AS 'alta_media_40_min',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 2 AND TIEMPO_ESCALA > 40, 1, 0)) AS 'alta_media_40_max',
                SUM(IF(INTERNALPRIORITY = 2 AND TIEMPO_ESCALA <= 60, 1, 0)) AS 'medias_60_min',
                SUM(IF(INTERNALPRIORITY = 2 AND TIEMPO_ESCALA > 60, 1, 0)) AS 'medias_60_max',
                SUM(IF(INTERNALPRIORITY = 3 AND TIEMPO_ESCALA <= 80, 1, 0)) AS 'bajas_80_min',
                SUM(IF(INTERNALPRIORITY = 3 AND TIEMPO_ESCALA > 80, 1, 0)) AS 'bajas_80_max',
                SUM(IF(INTERNALPRIORITY IS NULL, 1, 0)) AS 'nulos',
                COUNT(TICKETID) AS total_incidentes
            FROM maximo.INCIDENT
            WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP BY (CASE WHEN DESCRIPTION LIKE '%FAOC%' THEN 'FAOC'
                        WHEN DESCRIPTION LIKE '%FAOB%' THEN 'FAOB'
                        WHEN DESCRIPTION LIKE '%FAPP%' THEN 'FAPP'
                        WHEN DESCRIPTION LIKE '%FEE%' THEN 'FEE'
                        WHEN DESCRIPTION LIKE '%FI%' THEN 'FI'
                        WHEN DESCRIPTION LIKE '%FOIP%' THEN 'FOIP'
                        ELSE 'Sin coordinación'
                    END)
        ");
        return $query->result();
    }
    public function getDataWorkInfo($fdesde,$fhasta){
        $query = $this->db->query("
            SELECT TICKETID
            FROM maximo.INCIDENT
            WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
        ");
        $data =  $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }

    public function getTiempoNOCEste($fdesde,$fhasta) {
        $query = $this->db->query("
        SELECT TI.TICKETID, TI.ZONA_TKT,

        CASE WHEN UPPER(TI.RUTA_TKT) LIKE 'SERVICIOS FIJOS%' THEN
        
        IF(UPPER(TI.RUTA_TKT) LIKE '%AFECTACION%','AFECTACION',
        
                      IF(UPPER(TI.RUTA_TKT) LIKE '%DEGRADACION%','DEGRADACION',
        
                                    IF(UPPER(TI.RUTA_TKT) LIKE '%RECLAMACION%','RECLAMACION',
        
                                                   IF(UPPER(TI.RUTA_TKT) LIKE '%NOTIFICACION%', 'NOTIFICACION',
        
                                                                 IF(UPPER(TI.RUTA_TKT) LIKE '%SERVICIO AFECTADO%','INCIDENTE',
        
                                                                               IF(UPPER(TI.RUTA_TKT) LIKE '%SERVICIO DEGRADADO','PERFORMANCE',
        
                                                                                             IF(UPPER(TI.RUTA_TKT) LIKE '%SERVICIO PARCIALMENTE AFECTADO%', 'PERFORMANCE',
        
                                                                                                           IF(UPPER(TI.RUTA_TKT) LIKE '%SERVICIO VULNERABLE%', 'PERFORMANCE', TI.TIPO_TKT))))))))
        
        ELSE TI.TIPO_TKT END AS TIPO_TKT,
        
        TI.RUTA_TKT, TI.CLOSEDATE, TI.ACTUALFINISH, TI.STATUS,TI.INTERNALPRIORITY, TI.CHANGEDATE,TI.OWNERGROUP,TI.LOCATION,TI.REGIONAL,TI.CIUDAD_MUNICIPIO,TI.DESCRIPTION,
        
        TI.CREATIONDATE,GRU.GRUPO_INICIAL,REPLACE(TI.TIEMPO_VIDA_TKT,'.',',') AS TIEMPO_VIDA_TKT,REPLACE(TI.TIEMPO_RESOLUCION_TKT,'.',',') AS TIEMPO_RESOLUCION_TKT,REPLACE(TI.TIEMPO_DETECCION,'.',',') AS TIEMPO_DETECCION,REPLACE(TI.TIEMPO_ESCALA,'.',',') AS TIEMPO_ESCALA,REPLACE(TI.TIEMPO_FALLA,'.',',') AS TIEMPO_FALLA, REPLACE(TI.TIEMPO_OT_ALM,'.',',') AS TIEMPO_OT_ALM,
        
        ARC.GRUPO_ACT,LO.TIPO_ACTIVIDAD,(SELECT GCA.JEFATURA FROM carga.GRUPOS_MAXIMO GCA WHERE ARC.GRUPO_ACT = GCA.GRUPO) AS JEFATURA_ACTI
        
        ,REPLACE(LO.TIEMPO_REAL_ACT,'.',',') AS TIEMPO_REAL_ACT,WEEK(TI.CREATIONDATE) AS SEMANA,MONTH(TI.CREATIONDATE) AS MES,RAP.TIEMPO_FRONT,(RAP.TIEMPO_FRONT+IFNULL(CARE.TIEMPO_BO,0)) AS TIEMPO_NOC,TI.PROBLEM_CODE,TI.PROBLEM_DESCRIPTION,TI.CAUSE_CODE,TI.CAUSE_DESCRIPTION,TI.REMEDY_CODE,TI.REMEDY_DESCRIPTION
        
        FROM maximo.INCIDENT TI
        
        LEFT JOIN (SELECT TICKETID,MIN(OWNERGROUP)AS GRUPO_ACT FROM maximo.ACTIVITIES
        
        GROUP BY TICKETID)ARC
        
        ON TI.TICKETID = ARC.TICKETID
        
        LEFT JOIN
        
        (SELECT ARI.TICKETID,IF(RAC.WONUM LIKE 'OT%','OT',IF(RAC.WONUM LIKE 'TAS%', 'TAS', NULL)) AS TIPO_ACTIVIDAD,ARI.OWNERGROUP AS JEFATURA_ACTI,ARI.TIEMPO_REAL_ACT FROM maximo.ACTIVITIES ARI
        
        LEFT JOIN(
        
        SELECT TICKETID,MIN(WONUM) AS WONUM,MIN(CHANGEDATE) AS CHANGEDATE FROM maximo.ACTIVITIES
        
        GROUP BY TICKETID)RAC
        
        ON RAC.WONUM = ARI.WONUM
        
        WHERE RAC.WONUM IS NOT NULL)LO
        
        ON TI.TICKETID = LO.TICKETID
        
        LEFT JOIN
        
        (SELECT
        
            A.TICKETID,IF(A.TIEMPO_ESCALA <> 0,(A.TIEMPO_DETECCION + A.TIEMPO_ESCALA + TFRO.TIEMPO_FRONT),IF(A.TIEMPO_RESOLUCION_TKT IS NOT NULL,(A.TIEMPO_DETECCION + A.TIEMPO_RESOLUCION_TKT),
        
                      IF(A.ACTUALFINISH IS NOT NULL,(A.TIEMPO_DETECCION + (UNIX_TIMESTAMP(A.ACTUALFINISH) / 60)),(A.TIEMPO_DETECCION + (UNIX_TIMESTAMP(SYSDATE()) / 60))))) AS TIEMPO_FRONT
        
        FROM INCIDENT A LEFT JOIN(SELECT TICKETID, SUM(TIEMPO_REAL_ACT) AS TIEMPO_FRONT
        
        FROM(SELECT TICKETID, TIEMPO_REAL_ACT FROM maximo.ACTIVITIES WHERE OWNERGROUP LIKE 'FO%'
        
        UNION ALL SELECT TICKETID, TIEMPO_REAL_ACT FROM maximo.ACTIVITIES WHERE OWNERGROUP LIKE 'FRO%') TAUN GROUP BY TICKETID) TFRO ON A.TICKETID = TFRO.TICKETID)RAP
        
        ON TI.TICKETID = RAP.TICKETID
        
        LEFT JOIN
        
        (SELECT TICKETID AS TKTBO, SUM(TIEMPO_REAL_ACT) AS TIEMPO_BO
        
        FROM(SELECT TICKETID, TIEMPO_REAL_ACT FROM maximo.ACTIVITIES WHERE OWNERGROUP LIKE 'BO%') TABO GROUP BY TICKETID) CARE
        
        ON TI.TICKETID = CARE.TKTBO
        
        LEFT JOIN (
        
        SELECT TICKETID,MIN(ASSIGNEDOWNERGROUP) AS GRUPO_INICIAL,MIN(CHANGEDATE) AS FECHA_INICIAL FROM maximo.TKSTATUS
        
        GROUP BY TICKETID) GRU
        
        ON TI.TICKETID = GRU.TICKETID
        
        WHERE TI.CREATIONDATE  BETWEEN '$fdesde' AND '$fhasta';
        
         
        ");
        $data =  $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
}

/* End of file Dao_reportes_model.php */