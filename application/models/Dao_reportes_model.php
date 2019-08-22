<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dao_reportes_model extends CI_Model {
    public function getNemonicosAccordingDate($fi, $ff) {
        $this->db->where('(DESCRIPTION LIKE "%FAOC:%"');
        $this->db->or_where('DESCRIPTION LIKE "%FAOB:%"');
        $this->db->or_where('DESCRIPTION LIKE "%FAPP:%"');
        $this->db->or_where('DESCRIPTION LIKE "%FEE:%"');
        $this->db->or_where('DESCRIPTION LIKE "%FI:%"');
        $this->db->or_where('DESCRIPTION LIKE "%FOIP:%")');
        $this->db->where("DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'");
        $this->db->order_by('DESCRIPTION', 'DESC');
        $query = $this->db->get('maximo.INCIDENT');
        // echo '<pre>'; print_r($this->db->last_query()); echo '</pre>';
        // echo '<pre>'; print_r("======================"); echo '</pre>';
        return $query->result();
        // echo '<pre>'; print_r($query->result()); echo '</pre>';
    }
    public function getNemonicosCCAccordingDate($fi, $ff) {
        $this->db->where(' (DESCRIPTION LIKE "%CCPYR_PRUEB%"');
        $this->db->or_where('DESCRIPTION LIKE "%CCPYR_LIDER%"');
        $this->db->or_where('DESCRIPTION LIKE "%CCPYR_RUTIN%"');
        $this->db->or_where('DESCRIPTION LIKE "%CCCOM_REG%"');
        $this->db->or_where('DESCRIPTION LIKE "%CCREC_REC%"');
        $this->db->or_where('DESCRIPTION LIKE "%CCREC_IE%")');
        $this->db->where("DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'");
        $this->db->order_by('DESCRIPTION', 'DESC');
        $query = $this->db->get('maximo.INCIDENT');
        return $query->result();
    }
    //Retorna el nombre del trabajo, el subestado, y los puntos de acuerdo al id de las tablas puntos, tipo_trabajo y subestado --jc
    public function getInfoReportSlas($fdesde, $fhasta) {
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
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 1 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) <= 20, 1, 0)) AS 'alta_alta_20_min',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 1 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) > 20, 1, 0)) AS 'alta_alta_20_max',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 2 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) <= 40, 1, 0)) AS 'alta_media_40_min',
                SUM(IF(INTERNALPRIORITY = 1 AND URGENCY = 2 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) > 40, 1, 0)) AS 'alta_media_40_max',
                SUM(IF(INTERNALPRIORITY = 2 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) <= 60, 1, 0)) AS 'medias_60_min',
                SUM(IF(INTERNALPRIORITY = 2 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) > 60, 1, 0)) AS 'medias_60_max',
                SUM(IF(INTERNALPRIORITY = 3 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) <= 80, 1, 0)) AS 'bajas_80_min',
                SUM(IF(INTERNALPRIORITY = 3 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_VIDA_TKT, TIEMPO_ESCALA) > 80, 1, 0)) AS 'bajas_80_max',
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
    public function getDataWorkInfo($fdesde, $fhasta) {
        $query = $this->db->query("
            SELECT TICKETID
            FROM maximo.INCIDENT
            WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
        ");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getDataTiempoFija($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT DISTINCT TK.TICKETID ,TK.INTERNALPRIORITY,TK.STATUS,TK.CREATIONDATE,TK.ACTUALFINISH,ifnull(TK.CLOSEDATE,sysdate()) AS FECHA_CIERRE_TKT,TK.DESCRIPTION,TK.REGIONAL,TK.RUTA_TKT,TK.OWNERGROUP,GM.ASSIGNEDOWNERGROUP AS PRIMER_GRUPO,
        ROUND(IFNULL(EOTR.OTG,0)) AS TIEMPO_OTROS_GRUPOS,
        ROUND(TK.TIEMPO_ESCALA) AS TIEMPO_ESCALA_FO_M,
        ROUND(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0)) AS T_REAL_FO,
        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 0 AND 20,20,
            IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 21 AND 30,30,
                IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 31 AND 40,40,
                    IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 41 AND 50,50,
                    IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 51 AND 60,60,
                    IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 61 AND 70,70,
                    IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 71 AND 80,80,
                    IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 81 AND 90,90,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 91 AND 100,100,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 101 AND 120,120,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 121 AND 140,140,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 141 AND 160,160,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 161 AND 180,180,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 181 AND 200,200,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 201 AND 300,300,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 301 AND 400,400,
                        IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) BETWEEN 401 AND 500,500,
                            IF(ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0)) > 501,ROUND(IFNULL(TK.TIEMPO_ESCALA-IFNULL(EOTR.OTG,0),0),-2),0)))))))))))))))))) AS RG_TIEMPO_ESCALA_FO_M,
        REPLACE(ROUND((IFNULL(TBO.TIEMPO_ESCALA_BO,0)/60),1),'.',',') AS TIEMPO_ESCALA_BO_H,
        IF(ROUND(IFNULL(TBO.TIEMPO_ESCALA_BO,0)/60) BETWEEN 0 AND 1,'1',
            IF(ROUND(IFNULL(TBO.TIEMPO_ESCALA_BO,0)/60) BETWEEN 1 AND 4,'4',
                IF(ROUND(IFNULL(TBO.TIEMPO_ESCALA_BO,0)/60) BETWEEN 4 AND 12,'12',
                        IF(ROUND(IFNULL(TBO.TIEMPO_ESCALA_BO,0)/60) > 12,concat(cast(ROUND(IFNULL(TBO.TIEMPO_ESCALA_BO/(60*24),0)) as char(20)),' d'),'0')))) AS RG_TI_ESCALA_BO,
        IFNULL(FIQ.CAN_OT_FIBRA,0) AS CAN_OT_FIBRA,REPLACE(ROUND(IFNULL(FIQ.TI_OT_FIBRA,0)/60,1),'.',',') AS TI_OT_FIBRA_REAL_H,
        IF(IFNULL(FIQ.CAN_OT_FIBRA,0)>0,
        IF(ROUND(IFNULL(FIQ.TI_OT_FIBRA,0)/60) BETWEEN 0 AND 1,'1',
            IF(ROUND(IFNULL(FIQ.TI_OT_FIBRA,0)/60) BETWEEN 1 AND 4,'4',
                IF(ROUND(IFNULL(FIQ.TI_OT_FIBRA,0)/60) BETWEEN 4 AND 12,'12',
                        IF(ROUND(IFNULL(FIQ.TI_OT_FIBRA,0)/60) > 12,concat(cast(ROUND(IFNULL(FIQ.TI_OT_FIBRA/(60*24),0)) as char(20)),' d'),'0')))),0) AS RG_TI_OT_FIBRA,
        IFNULL(FIQ.CAN_OT_CCOAX,0) AS CAN_OT_CCOAX,REPLACE(ROUND(IFNULL(FIQ.TI_OT_CCOAX,0)/60,1),'.',',') AS TI_OT_CCOAX_REAL_H,
        IF(IFNULL(FIQ.CAN_OT_CCOAX,0)>0,
        IF(ROUND(IFNULL(FIQ.TI_OT_CCOAX,0)/60) BETWEEN 0 AND 1,'1',
            IF(ROUND(IFNULL(FIQ.TI_OT_CCOAX,0)/60) BETWEEN 1 AND 4,'4',
                IF(ROUND(IFNULL(FIQ.TI_OT_CCOAX,0)/60) BETWEEN 4 AND 12,'12',
                        IF(ROUND(IFNULL(FIQ.TI_OT_CCOAX,0)/60) > 12,concat(cast(ROUND(IFNULL(FIQ.TI_OT_CCOAX/(60*24),0)) as char(20)),' d'),'0')))),0) AS RG_TI_OT_CCOAX,
        IFNULL(FIQ.CAN_TAS_QA,0) AS CAN_TAS_QA,ROUND(IFNULL(FIQ.TI_TAS_QA,0)) AS TI_TAS_QA_REAL_M,
        IF(IFNULL(FIQ.CAN_TAS_QA,0)>0,
        IF(IFNULL(FIQ.TI_TAS_QA,0) BETWEEN 0 AND 20,20,
            IF(IFNULL(FIQ.TI_TAS_QA,0) BETWEEN 20 AND 30,30,
                IF(IFNULL(FIQ.TI_TAS_QA,0) BETWEEN 30 AND 40,40,
                    IF(IFNULL(FIQ.TI_TAS_QA,0) BETWEEN 40 AND 100,100,
                        IF(IFNULL(FIQ.TI_TAS_QA,0) > 100,ROUND(IFNULL(FIQ.TI_TAS_QA,0),-2),0))))),0) AS RG_TI_TAS_QA_M,
        ROUND((IFNULL((UNIX_TIMESTAMP(IFNULL(TK.CLOSEDATE, sysdate()))-UNIX_TIMESTAMP(FIQ.TI_MAX_QA)),0)/(60)),-2) AS TI_CIERRE_TAS_H,
        REPLACE(ROUND((IFNULL(FIQ.TIEMPO_CAMPO,0)/60),1),'.',',') AS TIEMPO_CAMPO_H,ROUND((IF(TK.CLOSEDATE IS NOT NULL, UNIX_TIMESTAMP(TK.CLOSEDATE)-UNIX_TIMESTAMP(TK.CREATIONDATE),UNIX_TIMESTAMP(SYSDATE())-unix_timestamp(TK.CREATIONDATE))/60)-2) AS TIEMPO_VIDA_TKT_H, REPLACE(IFNULL(TBO.TIEMPO_BO_H,0),'.',',') AS TIEMPO_BO_H
        FROM maximo.INCIDENT TK
        LEFT JOIN (
        SELECT C.TICKETID ,C.ASSIGNEDOWNERGROUP FROM maximo.TKSTATUS C
        INNER JOIN (
        SELECT TICKETID, MIN(CHANGEDATE) AS MIN_FEC FROM maximo.TKSTATUS
        GROUP BY TICKETID) I
        ON C.TICKETID = I.TICKETID
        AND I.MIN_FEC = C.CHANGEDATE)GM
        ON TK.TICKETID = GM.TICKETID
        LEFT JOIN (SELECT DISTINCT AC.TICKETID,
        TOTF.CAN_OT_FIBRA,
        TOTF.TI_OT_FIBRA,
        TOTC.CAN_OT_CCOAX,
        TOTC.TI_OT_CCOAX ,
        (SELECT COUNT(WORKTYPE) FROM maximo.ACTIVITIES CQA WHERE AC.TICKETID=CQA.TICKETID AND WORKTYPE = '1') AS CAN_TAS_QA,
        (SELECT IFNULL(SUM(TIEMPO_REAL_ACT),0) FROM maximo.ACTIVITIES TQA WHERE AC.TICKETID=TQA.TICKETID AND WORKTYPE = '1') AS TI_TAS_QA,
        (SELECT MAX(CHANGEDATE) AS TI_MAX_QA FROM maximo.ACTIVITIES MQA WHERE AC.TICKETID=MQA.TICKETID AND WORKTYPE= '1' ) AS TI_MAX_QA,
        TCA.TIEMPO_CAMPO
        FROM maximo.ACTIVITIES AC
        LEFT JOIN
        (SELECT TICKETID, COUNT(WORKTYPE) AS CAN_OT_FIBRA, (UNIX_TIMESTAMP(MAX(CHANGEDATE))-UNIX_TIMESTAMP(MIN(REPORTDATE)))/60 AS TI_OT_FIBRA
        FROM (SELECT TICKETID,WORKTYPE
        ,IF(STATUS NOT IN ('INPRG','PENDING','SUSPENDIDO','INPROG','ASIGNADO','ASSIGNED'),CHANGEDATE,SYSDATE())AS CHANGEDATE,
        REPORTDATE
        FROM maximo.ACTIVITIES
        WHERE WORKTYPE = 'CFIBRA')TCFI
        GROUP BY TICKETID)TOTF
        ON AC.TICKETID = TOTF.TICKETID
        LEFT JOIN
        (SELECT TICKETID, COUNT(WORKTYPE) AS CAN_OT_CCOAX, (UNIX_TIMESTAMP(MAX(CHANGEDATE))-UNIX_TIMESTAMP(MIN(REPORTDATE)))/60 AS TI_OT_CCOAX
        FROM (SELECT TICKETID,WORKTYPE
        ,IF(STATUS NOT IN ('INPRG','PENDING','SUSPENDIDO','INPROG','ASIGNADO','ASSIGNED'),CHANGEDATE,SYSDATE())AS CHANGEDATE,
        REPORTDATE
        FROM maximo.ACTIVITIES
        WHERE WORKTYPE = 'CCOAX')TCOAX
        GROUP BY TICKETID)TOTC
        ON AC.TICKETID = TOTC.TICKETID
        LEFT JOIN
        (SELECT TICKETID, (UNIX_TIMESTAMP(MAX(CHANGEDATE))-UNIX_TIMESTAMP(MIN(REPORTDATE)))/60 AS TIEMPO_CAMPO
        FROM (SELECT TICKETID,WORKTYPE
        ,IF(STATUS NOT IN ('INPRG','PENDING','SUSPENDIDO','INPROG','ASIGNADO','ASSIGNED'),CHANGEDATE,SYSDATE())AS CHANGEDATE,
        REPORTDATE
        FROM maximo.ACTIVITIES
        WHERE WORKTYPE IN('CFIBRA','CCOAX'))TC
        GROUP BY TICKETID)TCA
        ON AC.TICKETID= TCA.TICKETID) FIQ
        ON TK.TICKETID = FIQ.TICKETID
        LEFT JOIN
        (SELECT DISTINCT LIM.TICKETID, IF(LIM.TIEMPO_CAMPO<BO.TIEMPO_BO, (BO.TIEMPO_BO-LIM.TIEMPO_CAMPO)/60,
            IF(LIM.L_L>BO.BO_L,(UNIX_TIMESTAMP(LIM.L_L)-UNIX_TIMESTAMP(BO.BO_L))/60,
                IF(LIM.L_R<BO.BO_R,(UNIX_TIMESTAMP(BO.BO_R)-UNIX_TIMESTAMP(LIM.L_R))/60,0))) AS TIEMPO_BO_H,
                IF(LIM.L_L>BO.BO_L,(UNIX_TIMESTAMP(LIM.L_L)-UNIX_TIMESTAMP(BO.BO_L))/60,0) AS TIEMPO_ESCALA_BO FROM
        (
        SELECT TICKETID, MAX(CHANGEDATE) AS L_R,MIN(REPORTDATE) AS L_L, (UNIX_TIMESTAMP(MAX(CHANGEDATE))-UNIX_TIMESTAMP(MIN(REPORTDATE)))/60 TIEMPO_CAMPO FROM maximo.ACTIVITIES
        WHERE WORKTYPE IN('CFIBRA','CCOAX')
        GROUP BY TICKETID)LIM
        LEFT JOIN
        (
        SELECT distinct TICKETID, MAX(CHANGEDATE) AS BO_R,MIN(REPORTDATE) AS BO_L, (UNIX_TIMESTAMP(MAX(CHANGEDATE))-UNIX_TIMESTAMP(MIN(REPORTDATE)))/60 TIEMPO_BO FROM maximo.ACTIVITIES
        WHERE OWNERGROUP IN('BOCORE','BOE_MOVIL','BOVASCPD','BACKTXMW','BORANINC','BO_ENERGIA','BOCORETUR','BOPLATVAS','BOE_FIJA','BORAN','BO_TX_INTER','BOTRANSMISION','BOEMEDAT',
        'BOTXPLATMW','BODATOSIP_BBIP','BOENETASK','BO_ALAM_HOG','BO_SDH','BODATOS','BOPCRF','BOCORCPD','BOENERG','BONOCTXC','BO_ALAM_HOG_CABLE','BOIPRAN_ACCESO','BODATAPN',
        'BACK_AUT_PRUEBA','BOE_RUT_FHFC')
        GROUP BY TICKETID)BO
        ON LIM.TICKETID = BO.TICKETID)TBO
        ON TK.TICKETID=TBO.TICKETID
        LEFT JOIN
        (SELECT TICKETID,SUM(STATUS_TIME) AS OTG FROM maximo.TKSTATUS
        WHERE ASSIGNEDOWNERGROUP NOT IN ('FOACCESO','FOPERFORMANCE','FOHFC','FO-FALLAS ALTAS','FOENERGI','FOSERVICIO','FOCORE','FOVENTANAS','FORAN','FOPERFOR','FOINFRAESTRUCTURA','FOPLATAFORMA','FOGESTINTERMITENCIAS',
        'FO BBIP','FOGESINT','FOTV','FODATOS','FO_SDH','FOIPFOTONICO','FONOCTXM','FRONTOFFICE','FRONTCCI')
        GROUP BY TICKETID) EOTR
        ON TK.TICKETID = EOTR.TICKETID
        WHERE TK.RUTA_TKT LIKE '%SERVICIOS FIJOS%'
        AND TK.STATUS <> 'ELIMINADO' AND
        DATE_FORMAT(TK.CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';
        ");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getIncidentesFija($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT ALK.TICKETID, ALK.INTERNALPRIORITY,ALK.REGIONAL,
        (SELECT distinct FIRST_VALUE(RO.ASSIGNEDOWNERGROUP)OVER(ORDER BY CHANGEDATE) FROM maximo.TKSTATUS RO WHERE ALK.TICKETID=RO.TICKETID ) AS PRIMER_GRUPO,
        ALK.OWNERGROUP,ALK.CREATIONDATE,ALK.CLOSEDATE,ALK.ACTUALFINISH,ALK.STATUS
        ,ALK.CHANGEDATE AS STATUSDATE,ALK.RUTA_TKT,AC.WONUM AS ACTIVIDAD,AC.REPORTDATE AS FECHAREPORTE_ACTI,AC.CHANGEDATE AS FECHACAMBIO_ACTI,AC.STATUS AS ESTADO_ACTI FROM maximo.INCIDENT ALK
        LEFT JOIN (SELECT TICKETID, WONUM,REPORTDATE,CHANGEDATE,STATUS FROM maximo.ACTIVITIES) AC
        ON AC.TICKETID=ALK.TICKETID
        WHERE ALK.RUTA_TKT LIKE 'SERVICIOS FIJOS%'
        AND ALK.CREATIONDATE  BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getTiempoNOCEste($fdesde, $fhasta) {
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
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    //Retorna los incidentes de una coordinacion dentro de un rango de fechas
    public function getIncidentsByCoordination($fdesde, $fhasta, $coordinacion, $like2 = null) {
        $condicion = '';
        if ($like2 != null) {
            $condicion = "DESCRIPTION LIKE '%$like2%' AND";
        }
        $query = $this->db->query("
            SELECT TICKETID,
                ZONA_TKT,
                TIPO_TKT,
                CREATIONDATE,
                CLOSEDATE,
                ACTUALFINISH,
                STATUS,
                INTERNALPRIORITY,
                URGENCY,
                CREATEDBY,
                CHANGEDATE,
                OWNERGROUP,
                LOCATION,
                MUN100,
                AFECTACION_TOTAL_CORE,
                INCEXCLUIR,
                PROVEEDORES,
                TICKET_EXT,
                DESCRIPTION,
                EXTERNALSYSTEM,
                RUTA_TKT,
                INC_ALARMA,
                INCSOLUCION,
                GERENTE,
                REGIONAL,
                PROBLEM_CODE,
                PROBLEM_DESCRIPTION,
                CAUSE_CODE,
                CAUSE_DESCRIPTION,
                REMEDY_CODE,
                REMEDY_DESCRIPTION,
                TIEMPO_VIDA_TKT,
                TIEMPO_RESOLUCION_TKT,
                TIEMPO_DETECCION,
                TIEMPO_ESCALA,
                TIEMPO_FALLA
            FROM maximo.INCIDENT
            WHERE $condicion DESCRIPTION LIKE '%$coordinacion%'
            AND DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
        ");
        return $query->result();
    }
    //Retorna la cantidad de incidentes dentro y fuera de tiempos por cada customer Care dentro de un rango de tiempo
    public function getInfoReportSlasCustomer($fdesde, $fhasta) {
        $query = $this->db->query("
            SELECT
                (CASE WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Escritas%' THEN 'PQRs Escritas'
                    WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Investigacion%' THEN 'PQRs Investigación'
                    WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Investigacion-Legal%' THEN 'PQRs Investigación-Legal'
                    WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Cobertura%' THEN 'Cobertura'
                    WHEN DESCRIPTION LIKE '%CCREC_OOP%' THEN 'Sondas OPP'
                    ELSE 'Sin coordinación'
                END) AS coordinacion,
                SUM(IF(TIEMPO_ESCALA < 7200, 1, 0)) AS 'mayor_5_dias',
                SUM(IF(TIEMPO_ESCALA >= 7200, 1, 0)) AS 'menor_5_dias',
                SUM(IF(TIEMPO_ESCALA < 4320, 1, 0)) AS 'mayor_3_dias',
                SUM(IF(TIEMPO_ESCALA >= 4320, 1, 0)) AS 'menor_3_dias',
                COUNT(TICKETID) AS total_incidentes
            FROM maximo.INCIDENT
            WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP BY (CASE WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Escritas%' THEN 'PQRs Escritas'
                        WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Investigacion%' THEN 'PQRs Investigación'
                        WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Investigacion-Legal%' THEN 'PQRs Investigación-Legal'
                        WHEN DESCRIPTION LIKE '%CCREC_PQR%' AND DESCRIPTION LIKE '%Cobertura%' THEN 'Cobertura'
                        WHEN DESCRIPTION LIKE '%CCREC_OOP%' THEN 'Sondas OPP'
                        ELSE 'Sin coordinación'
                    END)
        ");
        return $query->result();
    }
    public function getNemonicosCCAccordingDateV2($fi, $ff) {
        $query = $this->db->query("
            SELECT CREATEDATE, DESCRIPTION
            FROM maximo.WORKLOG
            WHERE (DESCRIPTION LIKE '%TG:S%'
                OR DESCRIPTION LIKE '%TGT11S:%'
                OR DESCRIPTION LIKE '%TGT5S:%'
                OR DESCRIPTION LIKE '%CCCOM_MAIL%'
                OR DESCRIPTION LIKE '%CCCOM_CHATS%'
                OR DESCRIPTION LIKE '%CCREC_CCI%'
                OR DESCRIPTION LIKE '%CCREC_SON%')
            AND DATE_FORMAT(`CREATEDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'
            UNION ALL
            SELECT CREATIONDATE,DESCRIPTION FROM maximo.INCIDENT
            WHERE (DESCRIPTION LIKE '%TGR:%'
                OR DESCRIPTION LIKE '%TGT11R:%'
                OR DESCRIPTION LIKE '%TGT5R:%'
                OR DESCRIPTION LIKE '%CCREC_OOP%'
                OR DESCRIPTION LIKE '%CCREC_PQR%')
            AND DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'
        ");
        return $query->result();
    }
    public function getNemonicosFixedAccordingDate($fi, $ff) {
        $this->db->where('(DESCRIPTION LIKE "%FOHFC%"');
        $this->db->or_where('DESCRIPTION LIKE "%FOIP%"');
        $this->db->or_where('DESCRIPTION LIKE "%FOINF%"');
        $this->db->or_where('DESCRIPTION LIKE "%FOTV%"');
        $this->db->or_where('DESCRIPTION LIKE "%PILOTO TV%"');
        $this->db->or_where('DESCRIPTION LIKE "%FOSMU%")');
        $this->db->where("DATE_FORMAT(`CREATIONDATE`, '%Y-%m-%d') BETWEEN '$fi' AND '$ff'");
        $this->db->order_by('DESCRIPTION', 'DESC');
        $query = $this->db->get('maximo.INCIDENT');
        return $query->result();
    }
    //Retorna las notas de una coordinacion dentro de un rango de fechas
    public function getNotesByCoordination($fdesde, $fhasta, $nemonicos) {
        $query = $this->db->query("
            SELECT RECORDKEY,
                CREATEDATE,
                DESCRIPTION,
                MODIFYDATE,
                MODIFYBY,
                DESCRIPTION_LONGDESCRIPTION,
                CLASS,
                LOGTYPE
            FROM maximo.WORKLOG
            WHERE DESCRIPTION LIKE '%$nemonicos%'
            AND DATE_FORMAT(CREATEDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
        ");
//        print_r($this->db->last_query().';<br>');
        return $query->result();
    }
    public function export($opcion, $ini, $fin) {
        if ($ini == "" || $fin == "") {
            // echo "fechas vacias";
            if ($opcion == "energia") {
                $opcion = "energias";
            }
            if ($opcion == "plataforma") {
                $opcion = "plataformas";
            }
            $query = $this->db->query("DESC $opcion");
            $resultado = $query->result();
            $nameColumns = "";
            foreach ($resultado as $key => $value) {
                $nameColumns .= " o." . $value->Field . ",";
            }
            // echo $nameColumns;
            // var_dump($query->result());
            $query2 = $this->db->query(
                    "SELECT $nameColumns
                        l.id_logbooks,
                        l.inicio_actividad,
                        l.fin_actividad,
                        l.tipo_actividad,
                        l.estado,
                        l.num_tk_incidente,
                        l.descripcion,
                        CONCAT(u.nombres,' ',u.apellidos) AS ing,
                        l.id_users,
                        l.turno,
                        l.ot_tarea,
                        l.area_asignacion,
                        l.responsable,
                        l.caso_de_uso,
                        l.prioridad,
                        l.tipo_incidente,
                        l.estaciones_afectadas
                    FROM $opcion o
                    INNER JOIN logbooks l
                    ON o.id_logbooks = l.id_logbooks
                    INNER JOIN users u
                    ON l.id_users = u.id_users"
            );
            return $query2->result();
            // print_r($this->db->last_query());
        } else {
            if ($opcion == "energia") {
                $opcion = "energias";
            }
            if ($opcion == "plataforma") {
                $opcion = "plataformas";
            }
            $query = $this->db->query("DESC $opcion");
            $resultado = $query->result();
            $nameColumns = "";
            foreach ($resultado as $key => $value) {
                $nameColumns .= " o." . $value->Field . ",";
            }
            $query2 = $this->db->query(
                    "SELECT $nameColumns
                        l.id_logbooks,
                        l.inicio_actividad,
                        l.fin_actividad,
                        l.tipo_actividad,
                        l.estado,
                        l.num_tk_incidente,
                        l.descripcion,
                        CONCAT(u.nombres,' ',u.apellidos) AS ing,
                        l.id_users,
                        l.turno,
                        l.ot_tarea,
                        l.area_asignacion,
                        l.responsable,
                        l.caso_de_uso,
                        l.prioridad,
                        l.tipo_incidente,
                        l.estaciones_afectadas
                    FROM $opcion o INNER JOIN logbooks l ON o.id_logbooks = l.id_logbooks
                    INNER JOIN users u
                    ON l.id_users = u.id_users
                    WHERE l.inicio_actividad BETWEEN $ini AND $fin"
            );
            // print_r($this->db->last_query());
        }
    }
    public function getWorkInfo($fdesde, $fhasta) {
        $query = $this->db->query("
            SELECT inc.CREATEDBY AS 'CREADO POR',
            inc.TICKETID AS 'TICKET ID',
            wl.CREATEDATE AS 'CREACION NOTA',
            wl.DESCRIPTION AS 'RESUMEN NOTA',
            wl.DESCRIPTION_LONGDESCRIPTION AS 'DETALLE NOTA',
            inc.CREATIONDATE AS 'CREACION INCIDENTE',
            inc.STATUS AS 'ESTADO INCIDENTE',
            inc.CREATEDBY AS 'INCIDENTE CREADO POR',
            '' AS 'INCIDENTE CREADO NOMBRE',
            inc.DESCRIPTION AS 'DESCRIPCION INCIDENTE',
            inc.ACTUALFINISH AS 'FECHA CIERRE INCIDENTE',
            inc.RUTA_TKT AS 'RUTA CLASIFICACION',
            inc.TIPO_TKT AS 'TIPO INCIDENTE',
            art.DESCRIPTION AS 'ARTICULO CONFIGURACION',
            '' AS 'FECHA AFECTACION',
            CASE
                WHEN inc.INTERNALPRIORITY = 3 THEN 'Baja'
                WHEN inc.INTERNALPRIORITY = 2 THEN 'Media'
                WHEN inc.INTERNALPRIORITY = 1 THEN 'Alta'
                ELSE ''
            END AS 'PRIORIDAD',
            CASE
                WHEN inc.URGENCY = 3 THEN 'Baja'
                WHEN inc.URGENCY = 2 THEN 'Media'
                WHEN inc.URGENCY = 1 THEN 'Alta'
                ELSE ''
            END AS 'URGENCIA',
            'preguntar' AS 'IMPACTO',
            inc.PROVEEDORES AS 'PROVEEDORES',
            inc.LOCATION AS 'UBICACION',
            inc.OWNERGROUP AS 'GRUPO PROPIETARIO'
            FROM maximo.INCIDENT inc
            INNER JOIN maximo.WORKLOG wl
            ON wl.RECORDKEY = inc.TICKETID
            LEFT JOIN   maximo.ARTCNF art
            ON inc.TICKETID = art.TICKETID
            WHERE DATE_FORMAT(inc.CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getAlarmasAutomatismo($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT inc.TICKETID AS 'TICKET ID',
		inc.DESCRIPTION AS 'DESCRIPCION INCIDENTE',
        inc.STATUS AS 'ESTADO INCIDENTE',
         CASE
		WHEN inc.INTERNALPRIORITY = 3 THEN 'Baja'
		WHEN inc.INTERNALPRIORITY = 2 THEN 'Media'
        WHEN inc.INTERNALPRIORITY = 1 THEN 'Alta'
		ELSE ''
	END AS 'PRIORIDAD' ,
        inc.PROVEEDORES AS 'PROVEEDORES',
        inc.CREATIONDATE AS 'FECHA CREACION INCIDENTE',
        inc.ACTUALFINISH AS 'FECHA CIERRE INCIDENTE',
        inc.OWNERGROUP AS 'GRUPO PROPIETARIO',
        inc.CREATEDBY AS 'CREADO POR ID',
        '' AS 'CREADO POR NOMBRE',
        art.DESCRIPTION AS 'ARTICULO CONFIGURACION',
        inc.RUTA_TKT AS 'RUTA CLASIFICACION',
        alarm.NODE AS 'ELEMENTO DE RED',
        alarm.CONSEC_NBR AS 'ID GLOBAL',
        alarm.NUM_ALARMA AS 'ID ALARMA',
        alarm.NOMB_ALARMA AS 'ALARMA',
        alarm.CREADA AS 'FECHA CREACION ALARMA',
        alarm.CANCELADA AS 'FECHA CANCELACION ALARMA',
        inc.LOCATION AS 'UBICACION',
         CASE
		WHEN inc.INCEXCLUIR = 0 THEN 'No'
		WHEN inc.INCEXCLUIR = 1 THEN 'Si'
		ELSE ''
        END AS 'EXCLUSION',
        '' AS 'INCIDENTE EXCLUSION',
        inc.FAILURECODE AS 'INCIDENTE CODIGO FALLA',
        inc.CAUSE_CODE AS 'CODIGO CAUSA CIERRE'
        FROM maximo.INCIDENT inc
         INNER JOIN maximo.ALARMS alarm
          ON inc.TICKETID = alarm.TICKETID
          LEFT JOIN   maximo.ARTCNF art
          ON inc.TICKETID = art.TICKETID
          WHERE inc.DESCRIPTION like '%MC:%'
          AND inc.DESCRIPTION NOT LIKE '%MC:ALARMA%'
          AND inc.DESCRIPTION NOT LIKE '%MC: ALARMA%'
          AND inc.DESCRIPTION NOT LIKE '%MC: SIN TRA%'
          AND inc.DESCRIPTION NOT LIKE '%MC:SIN TRA%'
          AND inc.DESCRIPTION NOT LIKE '%MC:PERFORMANCE%'
            AND inc.DESCRIPTION NOT LIKE '%MC: PERFORMANCE%'
            AND inc.DESCRIPTION NOT LIKE '%MC:INTERMIT%'
            AND inc.DESCRIPTION NOT LIKE '%MC: INTERM%'
          and DATE_FORMAT(inc.CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getTareasFOPerformance($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT AC.WONUM AS TAREA,AC.REPORTDATE AS FECHA_CREACION_TAREA,AC.DESCRIPTION AS DESCRIPTION_TAREA, AC.STATUS, AC.OWNER,AC.TICKETID,IC.CREATIONDATE AS FECHA_CREA_INCIDENTE,IC.STATUS AS ESTADO_INCIDENTE, IC.DESCRIPTION AS DESCRIPCION_INCIDENTE,
        IC.ACTUALFINISH AS FECHA_CIERRE_INCIDENTE,WO.MODIFYBY AS CREADOR,WO.CREATEDATE AS FECHA_NOTA,WO.DESCRIPTION AS RESUMEN_NOTA,WO.DESCRIPTION_LONGDESCRIPTION AS DETALLE_NOTA
        FROM maximo.ACTIVITIES AC
        LEFT JOIN maximo.INCIDENT IC
        ON AC.TICKETID=IC.TICKETID
        LEFT JOIN maximo.WORKLOG WO
        ON AC.WONUM=WO.RECORDKEY
        WHERE AC.WONUM LIKE 'TAS%'
        AND IC.DESCRIPTION LIKE 'MC:%'

    AND WO.MODIFYBY NOT LIKE '%MXINTADM%'
    AND IC.DESCRIPTION NOT LIKE '%MC:PERFORMANCE%'
    AND IC.DESCRIPTION NOT LIKE '%MC: PERFORMANCE%'
    AND IC.DESCRIPTION NOT LIKE '%MC: PERFO%'
    AND IC.DESCRIPTION NOT LIKE '%MC:ALARMA%'
    AND IC.DESCRIPTION NOT LIKE '%MC: ALARMA%'
    AND IC.DESCRIPTION NOT LIKE '%MC: INCID%'
    AND IC.DESCRIPTION NOT LIKE '%MC:INCID%'
    AND IC.DESCRIPTION NOT LIKE '%MC: VARIACI%'
    AND IC.DESCRIPTION NOT LIKE '%MC:VARIACI%'
        AND IC.DESCRIPTION NOT LIKE '%MC: CRC PERFOR%'
        AND IC.DESCRIPTION NOT LIKE '%MC:CRC PERFOR%'
        AND IC.DESCRIPTION NOT LIKE '%MC: SIN TRA%'
    AND IC.DESCRIPTION NOT LIKE '%MC:SIN TRA%'
        AND IC.DESCRIPTION NOT LIKE '%MC: CRC :PER%'
        AND IC.DESCRIPTION NOT LIKE '%MC: CRC:PER%'

    AND ( AC.OWNER LIKE '%EHT3738A%'
    OR AC.OWNER LIKE '%EHT6335B%'
    OR AC.OWNER LIKE '%EHT7557A%'
    OR AC.OWNER LIKE '%ECM6616C%'
    OR AC.OWNER LIKE '%EHT6225A%'
    OR AC.OWNER LIKE '%ECM0147D%'
    OR AC.OWNER LIKE '%ECM5328C%'
    OR AC.OWNER LIKE '%EHT0444A%'
    OR AC.OWNER LIKE '%ECM0939B%'
    OR AC.OWNER LIKE '%ECM6746F%'
    OR AC.OWNER LIKE '%ECM5999D%'
    OR AC.OWNER LIKE '%ECM4900E%'
    OR AC.OWNER LIKE '%ECM1362B%'
    OR AC.OWNER IS NULL)


            AND DATE_FORMAT(AC.REPORTDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getTiempoAtencion($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT * FROM reportes.TIEMPO_ATENCION
        WHERE DATE_FORMAT(FECHA_CREACION_INC, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function getControlTicket($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT * FROM reportes.CONTROL_TICKETS
        WHERE DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    public function ReporteCciHfc($opcion, $fecha_ini = null, $fecha_fin = null) {
        $condicion = "";
        if ($fecha_fin != null && $fecha_ini != null) {
            $condicion = "AND DATE_FORMAT(iniAct, '%Y-%m-%d') BETWEEN '$fecha_ini' AND '$fecha_fin'";
        }
        $query = $this->db->query("
            SELECT typeP AS 'PRIORIDAD',
                incident AS 'INCIDENTE',
                engineer AS 'INGENIERO',
                beginDate AS 'FECHA INICIO',
                endDate AS 'FECHA FINAL',
                INCStatus AS 'ESTADO DEL INCIDENTE',
                activity AS 'ACTIVIDAD',
                obs AS 'OBSERVACIÓN',
                flowErr AS 'ERROR DE FLUJO',
                ErrWfm AS 'ERROR DE WFM',
                tqnExit AS 'TAS QC NO EXITOSO',
                pymes AS 'PYMES',
                mc AS 'MAL CATEGORIZADOS',
                otccc AS 'OT CERRADA SIN CAUSAS DE CIERRE',
                typeBinnacle AS 'TIPO BITACORA',
                iniAct AS 'FECHA INICIO DE ACTIVIDAD',
                finAct AS 'FECHA FINALIZACION DE ACTIVIDAD'
            FROM cci_hfc
            WHERE typeBinnacle = '$opcion'
            $condicion
        ");
        return $query->result();
    }
    public function getGestionPerformance($fdesde, $fhasta) {
        $query = $this->db->query("
        SELECT * FROM maximo.INCIDENT
        WHERE DESCRIPTION LIKE '%MC:%'
        and DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta';");
        $data = $query->result();
        $_SESSION['x'] = $data;
        return $data;
    }
    //Retorna la cantidad de tablas de un Schema pasado como parametro
    public function getTablesBySchema($schema) {
        $query = $this->db->query("
            SHOW FULL TABLES FROM $schema
        ");
        return $query->result();
    }
    //Retorna las columnas de la tabla pasada como parametro
    public function getColumnsByTable($schema, $table) {
        $query = $this->db->query("
            DESC $schema.$table
        ");
//        print_r($this->db->last_query().';<br>');
        return $query->result();
    }
    //Retorna el resultado del query pasado por parametro
    public function getGenerateReport($query) {
        $query = $this->db->query($query);
//        print_r($this->db->last_query().';<br>');
        return $query->result();
    }
    public function insertGenerateReport($data) {
        if ($this->db->insert('reportes_generados', $data)) {
            return true;
        } else {
            return false;
        }
    }

    //Retorna el listado de las consultas que se han generado por la plataforma
    public function getReportsDB() {
        $query = $this->db->query("
            SELECT id_reportes,
                nombre_reporte,
                query_reporte,
                columnas_reporte,
                creador_reporte
            FROM reportes_generados
        ");
        return $query->result();
    }

    public function getGetQueryReport($id) {
        $query = $this->db->query("
            SELECT REGEXP_REPLACE(query_reporte, '[0-9]{4}-[0-1][0-9]-[0-3][0-9]', 'fecha') AS query_reporte,
                columnas_reporte,
                nombre_reporte
            FROM reportes_generados
            WHERE id_reportes = $id
        ");
        return $query->result();
    }
   

     public function getgraphdeteccion($fdesde, $fhasta, $peticion){
        $condicional="SELECT DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') AS the_date, COUNT(*) AS count,
            SUM(IF(INTERNALPRIORITY = 1 AND TIEMPO_DETECCION <= 40, 1, 0)) AS 'P1_PASARON',
            SUM(IF(INTERNALPRIORITY = 1, 1, 0)) AS 'P1_TOTAL',
            SUM(IF(INTERNALPRIORITY = 2 AND TIEMPO_DETECCION <= 80, 1, 0)) AS 'P2_PASARON',
            SUM(IF(INTERNALPRIORITY = 2, 1, 0)) AS 'P2_TOTAL',
            SUM(IF(INTERNALPRIORITY = 3 AND TIEMPO_DETECCION <= 100, 1, 0)) AS 'P3_PASARON',
            SUM(IF(INTERNALPRIORITY = 3, 1, 0)) AS 'P3_TOTAL'

            FROM maximo.INCIDENT
            WHERE (" . $peticion . ")
            AND `OWNERGROUP` NOT LIKE '%FO_SDH%'
            AND `DESCRIPTION` NOT LIKE '%DEPU%'
            AND `DESCRIPTION` NOT LIKE '%FHG%'
            AND `DESCRIPTION` NOT LIKE '%FSP%'
            AND `DESCRIPTION` NOT LIKE '%MAIL%'
            AND `DESCRIPTION` NOT LIKE '%MG%'
            AND `DESCRIPTION` NOT LIKE '%NO EXITOSO%'
            AND `DESCRIPTION` NOT LIKE '%VM%'
            AND `DESCRIPTION` NOT LIKE '%VENTANA MANT%'
            AND `DESCRIPTION` NOT LIKE '%FEE%SIN PE%'
            AND `STATUS` != 'ELIMINADO'
            AND `STATUS` != 'CANCELADO'
            and DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP 
            BY the_date
            ";
            $query=$this->db->query($condicional);
            $data = $query->result();
            return $data;
    }
    public function getTETD ($fdesde,$fhasta, $condicion){
        $query=$this->db->query("
             SELECT DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') AS the_date, COUNT(*) AS count,
            SUM(IF(INTERNALPRIORITY = 1 AND  (TIEMPO_DETECCION + IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA)) <= 40, 1, 0)) AS 'P1_PASARON',
            SUM(IF(INTERNALPRIORITY = 1, 1, 0)) AS 'P1_TOTAL',
            SUM(IF(INTERNALPRIORITY = 2 AND (TIEMPO_DETECCION + IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA)) <= 80, 1, 0)) AS 'P2_PASARON',
            SUM(IF(INTERNALPRIORITY = 2, 1, 0)) AS 'P2_TOTAL',
            SUM(IF(INTERNALPRIORITY = 3 AND (TIEMPO_DETECCION + IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA)) <= 100, 1, 0)) AS 'P3_PASARON',
            SUM(IF(INTERNALPRIORITY = 3, 1, 0)) AS 'P3_TOTAL'

            FROM maximo.INCIDENT
            WHERE (" . $condicion . ")
            AND `OWNERGROUP` NOT LIKE '%FO_SDH%'
            AND `DESCRIPTION` NOT LIKE '%DEPU%'
            AND `DESCRIPTION` NOT LIKE '%FHG%'
            AND `DESCRIPTION` NOT LIKE '%FSP%'
            AND `DESCRIPTION` NOT LIKE '%MAIL%'
            AND `DESCRIPTION` NOT LIKE '%MG%'
            AND `DESCRIPTION` NOT LIKE '%NO EXITOSO%'
            AND `DESCRIPTION` NOT LIKE '%VM%'
            AND `DESCRIPTION` NOT LIKE '%VENTANA MANT%'
            AND `DESCRIPTION` NOT LIKE '%FEE%SIN PE%'
            AND `STATUS` != 'ELIMINADO'
            AND `STATUS` != 'CANCELADO'
            and DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP BY 1
            ");
            return $query->result();
    }

    public function getIncidentesCerrados($fdesde, $fhasta){
        $query=$this->db->query("
            SELECT INC.TICKETID, INC.CREATIONDATE, INC.CREATEDBY, PE.DISPLAYNAME AS 'NOMBRE_CREADOR', INC.DESCRIPTION, INC.STATUS, TK.CHANGEBY, PER.DISPLAYNAME, INC.INTERNALPRIORITY, INC.URGENCY,  INC.CAUSE_CODE, INC.CAUSE_DESCRIPTION, INC.REMEDY_CODE, INC.REMEDY_DESCRIPTION
            FROM maximo.INCIDENT INC
            LEFT JOIN maximo.TKSTATUS TK
            ON INC.TICKETID = TK.TICKETID
            LEFT JOIN maximo.PERSON PE
            ON INC.CREATEDBY = PE.PERSONID
            LEFT JOIN maximo.PERSON PER
            ON TK.CHANGEBY = PER.PERSONID
            WHERE  INC.STATUS = 'CERRADO'
            AND TK.STATUS = 'CERRADO'
            AND INC.TICKETID LIKE '%INC%'
            and DATE_FORMAT(INC.CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            ");
             $_SESSION['x'] = $query->result();
        return $query->result();
    }
    

    public function getGraphInfo($fdesde, $fhasta, $condicion) {
        $str =  "SELECT DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') AS the_date, COUNT(*) AS count,
            SUM(IF(INTERNALPRIORITY = 1 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA) <= 40, 1, 0)) AS 'P1_PASARON',
            SUM(IF(INTERNALPRIORITY = 1, 1, 0)) AS 'P1_TOTAL',
            SUM(IF(INTERNALPRIORITY = 2 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA) <= 80, 1, 0)) AS 'P2_PASARON',
            SUM(IF(INTERNALPRIORITY = 2, 1, 0)) AS 'P2_TOTAL',
            SUM(IF(INTERNALPRIORITY = 3 AND IF(TIEMPO_ESCALA = '0.000', TIEMPO_FALLA, TIEMPO_ESCALA) <= 100, 1, 0)) AS 'P3_PASARON',
            SUM(IF(INTERNALPRIORITY = 3, 1, 0)) AS 'P3_TOTAL'
            FROM maximo.INCIDENT
            WHERE (" . $condicion .")
            AND `OWNERGROUP` NOT LIKE '%FO_SDH%'
            AND `DESCRIPTION` NOT LIKE '%DEPU%'
            AND `DESCRIPTION` NOT LIKE '%FHG%'
            AND `DESCRIPTION` NOT LIKE '%FSP%'
            AND `DESCRIPTION` NOT LIKE '%MAIL%'
            AND `DESCRIPTION` NOT LIKE '%MG%'
            AND `DESCRIPTION` NOT LIKE '%NO EXITOSO%'
            AND `DESCRIPTION` NOT LIKE '%VM%'
            AND `DESCRIPTION` NOT LIKE '%VENTANA MANT%'
            AND `DESCRIPTION` NOT LIKE '%FEE%SIN PE%'
            AND `STATUS` != 'ELIMINADO'
            AND `STATUS` != 'CANCELADO'
            and DATE_FORMAT(CREATIONDATE, '%Y-%m-%d') BETWEEN '$fdesde' AND '$fhasta'
            GROUP
            BY the_date ";
        $query = $this->db->query($str);


        $data = $query->result();
        // $_SESSION['x'] = $data;
        return $data;
    }
}
/* End of file Dao_reportes_model.php */
