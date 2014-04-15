<?php

$config = array(
    'signup' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'label' => 'PasswordConfirmation',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required'
        )
    ),
    'email' => array(
        array(
            'field' => 'emailaddress',
            'label' => 'EmailAddress',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'message',
            'label' => 'MessageBody',
            'rules' => 'required'
        )
    ),
    'alta_ciclo' => array(
        array(
            'field' => "ciclo",
            'label' => 'Ciclo',
            'rules' => 'required'
        ),
        array(
            'field' => "vigente",
            'label' => 'Ciclo Vigente',
            'rules' => 'required'
        ),
        array(
            'field' => "activo",
            'label' => 'Ciclo Activo',
            'rules' => 'required'
        )
    ),
    'alta_producto' => array(
        array(
            'field' => "nom",
            'label' => 'Nombre del Producto',
            'rules' => 'required'
        ),
        array(
            'field' => "condu",
            'label' => 'Condusef',
            'rules' => 'required'
        ),
        array(
            'field' => "descripcion",
            'label' => 'Descripción del Producto',
            'rules' => 'required'
        )
    ),
    'alta_universidad' => array(
        array(
            'field' => "razon",
            'label' => 'Razon Social',
            'rules' => 'trim|min_length[3]|max_length[250]'
        ),
        array(
            'field' => "nombre",
            'label' => 'Nombre Comercial',
            'rules' => 'trim|required|min_length[2]|max_length[250]'
        ),
        array(
            'field' => "convenio",
            'label' => 'Convenio CIE',
            'rules' => 'trim'
        )
    ),
    'alta_campus' => array(
        array(
            'field' => "uni",
            'label' => 'Universidad',
            'rules' => 'trim|required|greater_than[0]'
        ),
        array(
            'field' => "nombre",
            'label' => 'Nombre del Campus',
            'rules' => 'trim|required|min_length[2]|max_length[250]'
        ),
        array(
            'field' => "code",
            'label' => 'Código del Campus',
            'rules' => ''
        )
    ),
    'solicitud_rules' => array(
        array(
            'field' => "universidad",
            'label' => 'Universidad',
            'rules' => 'trim|required|greater_than[0]'
        ),
        array(
            'field' => "cam",
            'label' => 'Campus',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "producto",
            'label' => 'Producto',
            'rules' => 'required|greater_than[0]'
        ),
        array(
            'field' => "ciclox",
            'label' => 'Ciclo',
            'rules' => ''
        ),
        array(
            'field' => "nivel",
            'label' => 'Nivel',
            'rules' => ''
        ),
        array(
            'field' => "especialidad",
            'label' => 'Carrera',
            'rules' => 'required'
        ),
        array(
            'field' => "ciclo_escolar",
            'label' => 'ciclo Escolar',
            'rules' => ''
        ),
        array(
            'field' => "avance_por",
            'label' => 'Porcentaje de Avance',
            'rules' => 'numeric|less_than[100]'
        ),
        array(
            'field' => "oficial",
            'label' => 'Identificación Oficial',
            'rules' => ''
        ),
        array(
            'field' => "numero_oficial",
            'label' => 'Número Identificación Oficial',
            'rules' => ''
        ),
        array(
            'field' => "nombre1",
            'label' => 'Nombre (1)',
            'rules' => ''
        ),
        array(
            'field' => "nombre2",
            'label' => 'Nombre (2)',
            'rules' => ''
        ),
        array(
            'field' => "apater",
            'label' => 'Apellido Paterno',
            'rules' => ''
        ),
        array(
            'field' => "amater",
            'label' => 'Apellido Materno',
            'rules' => ''
        ),
        array(
            'field' => "rfc",
            'label' => 'RFC',
            'rules' => ''
        ),
        array(
            'field' => "civil",
            'label' => 'Estado Civil',
            'rules' => ''
        ),
        array(
            'field' => "conyuge",
            'label' => 'Nombre Conyuge',
            'rules' => ''
        ),
        array(
            'field' => "nac",
            'label' => 'Fecha de Nacimiento',
            'rules' => 'valida_fechas_esp'
        ),
        array(
            'field' => "nac_place",
            'label' => 'Lugar de Nacimiento',
            'rules' => ''
        ),
        array(
            'field' => "promedio",
            'label' => 'Promedio General',
            'rules' => 'numeric'
        ),
        array(
            'field' => "email",
            'label' => 'Correo Electrónico',
            'rules' => 'valid_email'
        ),
        array(
            'field' => "cellphone",
            'label' => 'Celular',
            'rules' => ''
        ),
        array(
            'field' => "phone",
            'label' => 'Teléfono Fijo',
            'rules' => ''
        ),
        array(
            'field' => "calle",
            'label' => 'Calle',
            'rules' => ''
        ),
        array(
            'field' => "interior",
            'label' => 'No. Interior',
            'rules' => ''
        ),
        array(
            'field' => "exterior",
            'label' => 'No Exterior',
            'rules' => ''
        ),
        array(
            'field' => "colonia",
            'label' => 'Colonia',
            'rules' => ''
        ),
        array(
            'field' => "delegacion",
            'label' => 'Delegación',
            'rules' => ''
        ),
        array(
            'field' => "postal",
            'label' => 'Código Postal',
            'rules' => 'numeric'
        ),
        array(
            'field' => "ciudad",
            'label' => 'Ciudad',
            'rules' => ''
        ),
        array(
            'field' => "estado",
            'label' => 'Estado',
            'rules' => ''
        ),
        array(
            'field' => "casa",
            'label' => 'Casa donde habita',
            'rules' => ''
        ),
        array(
            'field' => "trabajox",
            'label' => 'Actividad Laboral',
            'rules' => ''
        ),
        array(
            'field' => "actividad_alumno",
            'label' => 'Actividad',
            'rules' => ''
        ),
        array(
            'field' => "empresa",
            'label' => 'Nombre de la Empresa',
            'rules' => ''
        ),
        array(
            'field' => "antiguedad",
            'label' => 'Antiguedad',
            'rules' => 'numeric'
        ),
        array(
            'field' => "puesto",
            'label' => 'puesto',
            'rules' => ''
        ),
        array(
            'field' => "telefono_emp",
            'label' => 'teléfono Empresa',
            'rules' => ''
        ),
        array(
            'field' => "ingreso",
            'label' => 'Ingreso Mensual',
            'rules' => ''
        ),
        array(
            'field' => "egreso",
            'label' => 'Egreso Mensual',
            'rules' => ''
        ),
        array(
            'field' => "oficiala1",
            'label' => 'Identificación Oficial Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "numero_oficiala1",
            'label' => 'Número Identificación Oficial Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "nombre1_a1",
            'label' => 'Nombre (1) Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "nombre2_a1",
            'label' => 'Nombre (2) Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "apater_a1",
            'label' => 'Apellido Paterno Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "amater_a1",
            'label' => 'Apellido Materno Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "parentesco_a1",
            'label' => 'Parentesco Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "civil_a1",
            'label' => 'Estado Civil Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "calle_a1",
            'label' => 'Calle Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "interior_a1",
            'label' => 'No. Interior Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "exterior_a1",
            'label' => 'No. Exterior Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "colonia_a1",
            'label' => 'Colonia Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "delegacion_a1",
            'label' => 'Delegación Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "postal_a1",
            'label' => 'código Postal Aval 1',
            'rules' => 'numeric'
        ),
        array(
            'field' => "ciudad_a1",
            'label' => 'Ciudad Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "estado_a1",
            'label' => 'Estado Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "telefono_fijo_a1",
            'label' => 'Teléfono Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "casa_a1",
            'label' => 'Casa donde habita Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "naca_1",
            'label' => 'Fecha de Nacimiento Aval 1',
            'rules' => 'valida_fechas_esp'
        ),
        array(
            'field' => "trabajo_a1",
            'label' => 'Automóvil Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "modelo_a1",
            'label' => 'Modelo Automóvil Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "actividad_a1",
            'label' => 'Actividad Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "empresa_a1",
            'label' => 'Nombre de la Empresa Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "antiguedad_a1",
            'label' => 'Antiguedad Aval 1',
            'rules' => 'numeric'
        ),
        array(
            'field' => "puesto_a1",
            'label' => 'puesto Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "telefono_a1",
            'label' => 'teléfono Empresa Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "ingreso_a1",
            'label' => 'Ingreso Mensual Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "egreso_a1",
            'label' => 'Egreso Mensual Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyuact_a1",
            'label' => 'Actividad Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyuemp_a1",
            'label' => 'Nombre de la Empresa Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyuant_a1",
            'label' => 'Antiguedad Aval 1',
            'rules' => 'numeric'
        ),
        array(
            'field' => "conyupuesto_a1",
            'label' => 'puesto Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyutel_a1",
            'label' => 'teléfono Empresa Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyuing_a1",
            'label' => 'Ingreso Mensual Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "conyueg_a1",
            'label' => 'Ingreso Mensual Aval 1',
            'rules' => ''
        ),
        array(
            'field' => "oficiala2",
            'label' => 'Identificación Oficial Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "numero_oficiala2",
            'label' => 'Número Identificación Oficial Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "nombre1_a2",
            'label' => 'Nombre (1) Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "nombre2_a2",
            'label' => 'Nombre (2) Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "apater_a2",
            'label' => 'Apellido Paterno Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "amater_a2",
            'label' => 'Apellido Materno Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "parentesco_a2",
            'label' => 'Parentesco Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "civil_a2",
            'label' => 'Estado Civil Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "calle_a2",
            'label' => 'Calle Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "interior_a2",
            'label' => 'No Interior Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "exterior_a2",
            'label' => 'No Exterior Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "colonia_a2",
            'label' => 'Colonia Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "delegacion_a2",
            'label' => 'Delegación Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "postal_a2",
            'label' => 'código Postal Aval 2',
            'rules' => 'numeric'
        ),
        array(
            'field' => "ciudad_a2",
            'label' => 'Ciudad Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "estado_a2",
            'label' => 'Estado Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "telefono_fijo_a2",
            'label' => 'Teléfono Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "casa_a2",
            'label' => 'Casa donde habita Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "naca_2",
            'label' => 'Fecha de Nacimiento Aval 2',
            'rules' => 'valida_fechas_esp'
        ),
        array(
            'field' => "trabajo_a2",
            'label' => 'Automóvil Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "modelo_a2",
            'label' => 'Modelo Automóvil Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "actividad_a2",
            'label' => 'Actividad Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "empresa_a2",
            'label' => 'Nombre de la Empresa Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "antiguedad_a2",
            'label' => 'Antiguedad Aval 2',
            'rules' => 'numeric'
        ),
        array(
            'field' => "puesto_a2",
            'label' => 'puesto Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "telefono_a2",
            'label' => 'teléfono Empresa Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "ingreso_a2",
            'label' => 'Ingreso Mensual Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "egreso_a2",
            'label' => 'Egreso Mensual Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyuact_a2",
            'label' => 'Actividad Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyuemp_a2",
            'label' => 'Nombre de la Empresa Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyuant_a2",
            'label' => 'Antiguedad Aval 2',
            'rules' => 'numeric'
        ),
        array(
            'field' => "conyupuesto_a2",
            'label' => 'puesto Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyutel_a2",
            'label' => 'teléfono Empresa Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyuing_a2",
            'label' => 'Ingreso Mensual Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "conyueg_a2",
            'label' => 'Ingreso Mensual Aval 2',
            'rules' => ''
        ),
        array(
            'field' => "comentarios",
            'label' => 'Comentarios',
            'rules' => ''
        )
    ),
    'editar_carrera' => array(
        array(
            'field' => "titulo",
            'label' => 'Carrera',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "marca_plan",
            'label' => 'Periodo',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "duracion",
            'label' => 'No. de Periodos',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_semestral",
            'label' => 'Costo Periodo',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_total",
            'label' => 'Costo Carrera',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "ingresoFE",
            'label' => 'Ingreso FE',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "numero_materias",
            'label' => 'Número de Materias',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_materia",
            'label' => 'Costo Materia',
            'rules' => 'trim|required|numeric'
        )
    ),
    'alta_carrera' => array(
        array(
            'field' => "titulo",
            'label' => 'Carrera',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "uni",
            'label' => 'Universidad',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "campus",
            'label' => 'Campus',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "marca_plan",
            'label' => 'Periodo',
            'rules' => 'trim|required'
        ),
        array(
            'field' => "duracion",
            'label' => 'No. de Periodos',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_semestral",
            'label' => 'Costo Periodo',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_total",
            'label' => 'Costo Carrera',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "ingresoFE",
            'label' => 'Ingreso FE',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "numero_materias",
            'label' => 'Número de Materias',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => "costo_materia",
            'label' => 'Costo Materia',
            'rules' => 'trim|required|numeric'
        )
    ),
    'login' => array(
        array(
            'field' => 'user',
            'label' => 'Usuario',
            'rules' => 'required|callback_username_check|trim'
        ),
        array(
            'field' => 'pass',
            'label' => 'Contraseña',
            'rules' => 'required|trim'
        )
    ),
    'alta_expediente' => array(
        array(
            'field' => 'uni',
            'label' => 'Universidad',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'cam',
            'label' => 'Campus',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'mat',
            'label' => 'Matrícula',
            'rules' => 'required|callback__unique_matricula|trim'
        )
    ),
    'borrar_expediente' => array(
        array(
            'field' => 'confirmar',
            'label' => 'Confirmar',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'comentario',
            'label' => 'Motivos para borrar',
            'rules' => 'required|trim'
        )
    ),
    'buro_rules' => array(
        array(
            'field' => 'idalumno',
            'label' => 'Alumno',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'idburo',
            'label' => 'Buro ID',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mat',
            'label' => 'Matrícula',
            'rules' => 'required|trim'
        )
    ),
    'cedula_analisis' => array(
        array(
            'field' => 'tipo_ingreso',
            'label' => 'Tipo de Ingreso',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'modalidad',
            'label' => 'Modalidad',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'avance_por',
            'label' => 'Avance',
            'rules' => 'trim'
        ),
        array(
            'field' => 'linea_solicitada',
            'label' => 'Línea Solicitada',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'tipo_linea',
            'label' => 'Tipo de Línea',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'adeudo',
            'label' => 'Adeudo',
            'rules' => 'required|trim|numeric'
        ),
        array(
            'field' => 'cuenta_alu',
            'label' => 'Cuenta Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_actual_alu',
            'label' => 'Saldo Actual Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_vencido_alu',
            'label' => 'Saldo Vencido Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mop_alumno',
            'label' => 'MOP Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'com_alumno',
            'label' => 'Comentarios Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cuenta_aval1',
            'label' => 'Cuenta Aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_actual_aval1',
            'label' => 'Saldo Actual Aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_vencido_aval1',
            'label' => 'Saldo Vencido Aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mop_aval1',
            'label' => 'MOP Aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'com_aval2',
            'label' => 'Comentarios Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cuenta_aval2',
            'label' => 'Cuenta Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_actual_aval2',
            'label' => 'Saldo Actual Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'saldo_vencido_aval2',
            'label' => 'Saldo Vencido Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mop_aval2',
            'label' => 'MOP Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'com_aval2',
            'label' => 'Comentarios Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario_buro',
            'label' => 'Comentario Buro',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingreso_minimo',
            'label' => 'Avance',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'inmueble',
            'label' => 'Presenta Bien Inmueble',
            'rules' => 'trim'
        ),
        array(
            'field' => 'excepcion',
            'label' => 'Excepcion Bien Inmueble',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingreso_bruto_alu',
            'label' => 'Ingreso Bruto Alumno',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'documentacion_alumno',
            'label' => 'Documento Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario_bruto_alumno',
            'label' => 'Comentario Alumno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingreso_bruto_aval1',
            'label' => 'Ingreso Bruto Aval 1',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'documentacion_aval1',
            'label' => 'Documento aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario_bruto_aval1',
            'label' => 'Comentario Aval 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingreso_bruto_aval2',
            'label' => 'Ingreso Bruto Aval 2',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'documentacion_aval2',
            'label' => 'Documento aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario_bruto_aval2',
            'label' => 'comentario Aval 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_comprobados',
            'label' => 'Ingresos Comprobados',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'pago_buro',
            'label' => 'Pago Buro',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'comentario_gral',
            'label' => 'Comentario General',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'terminar',
            'label' => 'Terminar',
            'rules' => 'trim'
        )
    ),
    'analisis_rules' => array(
        array(
            'field' => 'status',
            'label' => 'Estado de la operación',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'linea_global',
            'label' => 'Línea global',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'importe',
            'label' => 'Importar',
            'rules' => 'required|trim'
        ),        
        array(
            'field' => 'porc_credito',
            'label' => 'Porcentaje del crédito',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'res_pago',
            'label' => 'Resultado (paramétrico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'obs_pago',
            'label' => 'Observaciones (paramétrico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cond_pago',
            'label' => 'Condiciones (paramétrico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'res_buro',
            'label' => 'Resultado (buró de crédito)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'obs_buro',
            'label' => 'Observaciones (buró de crédito)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cond_buro',
            'label' => 'Condiciones (buró de crédito)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'res_estudio',
            'label' => 'Resultado (estudio socioeconómico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'obs_estudio',
            'label' => 'Observaciones (estudio socioeconómico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cond_estudio',
            'label' => 'Condiciones (estudio socioeconómico)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval1_respaldo',
            'label' => 'Respaldo (aval 1)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval1_valor',
            'label' => 'Valor estimado (aval 1)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval2_respaldo',
            'label' => 'Respaldo (aval 2)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval2_valor',
            'label' => 'Valor estimado (aval 2)',
            'rules' => 'trim'
        ),        
        array(
            'field' => 'tipo_obs',
            'label' => 'Tipo de observación',
            'rules' => 'trim'
        ),        
        array(
            'field' => 'comentario_observacion',
            'label' => 'Comentario (observaciones)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'politicas',
            'label' => 'Políticas de otorgamiento de crédito',
            'rules' => 'trim'
        ),
        array(
            'field' => 'firma[]',
            'label' => 'firmas',
            'rules' => 'trim|callback_revisa_firmas'
        )
    ),
    'contrato_rules' => array(
        array(
            'field' => 'cat',
            'label' => 'CAT Informativo',
            'rules' => 'required|numeric|trim'
        ),
        array(
            'field' => 'lugar_firma',
            'label' => 'Lugar de la Firma',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'plazo_credito',
            'label' => 'Plazo Crédito (Meses)',
            'rules' => 'required|numeric|trim'
        ),
        array(
            'field' => 'del',
            'label' => 'Del',
            'rules' => 'required|numeric|exact_length[4]|trim'
        ),
        array(
            'field' => 'al',
            'label' => 'Al',
            'rules' => 'required|numeric|exact_length[4]|trim'
        ),
        array(
            'field' => 'primer_disposicion',
            'label' => 'Primer Disposición',
            'rules' => 'required|trim|callback__menor_a_disposicion'
        ),
        array(
            'field' => 'pago_mensual',
            'label' => 'Pago Mensual',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'pago_extraordinario',
            'label' => 'Pago Extraordinario',
            'rules' => 'required|trim'
        ),        
        array(
            'field' => 'adeudo_universidad',
            'label' => 'Adeudo con la Universidad',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'periodo_disposicion',
            'label' => 'Periodo de Disposición',
            'rules' => 'required|numeric|trim'
        ),
        array(
            'field' => 'fecha_suscripcion',
            'label' => 'Fecha de Suscripción',
            'rules' => 'required|valida_fechas_esp|trim'
        ),
        array(
            'field' => 'tasa_fija',
            'label' => 'Tasa Fija',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'tasa_moratoria',
            'label' => 'Tasa Moratoria',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'numero_referencia',
            'label' => 'Número de Referencia',
            'rules' => 'required|trim|strtoupper'
        ),
        array(
            'field' => 'digito_verificador',
            'label' => 'Dígito Verificador',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'comision_disposicion',
            'label' => 'Comisión por Disposición',
            'rules' => 'trim'
        ),
        array(
            'field' => 'enviar_mesa',
            'label' => 'Enviar a mesa de control',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario',
            'label' => 'Comentario',
            'rules' => 'required|trim'
        )
    ),
    'tabla_pagos' => array(
        array(
            'field' => 'idalumno',
            'label' => 'Alumno',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'idcontrato',
            'label' => 'Contrato ID',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mat',
            'label' => 'Matrícula',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'numero',
            'label' => 'Número de Pagaré',
            'rules' => 'required|greater_than[0]|trim'
        ),
        array(
            'field' => 'adeudo',
            'label' => 'Adeudo con Universidad',
            'rules' => 'trim'
        )
    ),
    'pagare_rules' => array(
        array(
            'field' => 'fecha_vencimiento',
            'label' => 'Fecha de Vencimiento',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'plazo',
            'label' => 'Plazo',
            'rules' => 'required|numeric|trim'
        ),
        array(
            'field' => 'fecha_suscripcion',
            'label' => 'Plazo',
            'rules' => 'required|trim'
        )
    ),
    'inv_personal' => array(
        array(
            'field' => 'nom_solicitante',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'sxo',
            'label' => 'Sexo',
            'rules' => 'trim'
        ),
        array(
         'field'=>'civil',
         'label'=>'Estado civil',
            'rules'=>'trim',
        ),
        array(
            'field' => 'regimen',
            'label' => 'Regimen',
            'rules' => 'trim'
        ),
        array(
            'field' => 'num_hermanos',
            'label' => 'Numero de Hermanos',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'nombre_conyuge',
            'label' => 'Nombre del Conyuge',
            'rules' => 'trim'
        ),
        array(
            'field' => 'edad',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'fecha_1',
            'label' => 'FECHA DE ELABORACIÓN DEL SOCIOECONÓMICO',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'lugar_finan',
            'label' => 'FECHA DE NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'rfc',
            'label' => 'RFC',
            'rules' => 'trim'
        ),
        array(
            'field' => 'edad',
            'label' => 'EDAD',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'dependientes',
            'label' => 'DEPENDIENTES',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'edades',
            'label' => 'EDADES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'fecha2',
            'label' => 'FECHA NACIMIENTO',
            'rules' => 'valida_fechas_esp|trim'
        ),array(
            'field' => 'lugar_nacimiento',
            'label' => 'LUGAR NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'situacionpadres',
            'label' => 'Situacion padres',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_vive',
            'label' => 'Vive',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_trabaja',
            'label' => 'Trabaja Padre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_actividad',
            'label' => 'Actividad Padre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_estudios',
            'label' => 'Grado de estudios Padre',
            'rules' => 'trim'
        ),array(
            'field' => 'madre_vive',
            'label' => 'Vive madre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_trabaja',
            'label' => 'Trabaja madre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_actividad',
            'label' => 'Actividad Principal',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_estudios',
            'label' => 'Grado Estudios Madre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'calle',
            'label' => 'Calle y Numero',
            'rules' => 'trim'
        ),
        array(
            'field' => 'localidad',
            'label' => 'Localidad',
            'rules' => 'trim'
        ),
        array(
            'field' => 'tel',
            'label' => 'Telefono',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mail',
            'label' => 'Email',
            'rules' => 'valid_email|trim'
        ),
        array(
            'field' => 'domicilio_correspondencia',
            'label' => 'Domicilio que se enviara la correspondencia ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'colonia',
            'label' => 'Colonia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'calles',
            'label' => 'Entre las calles',
            'rules' => 'trim'
        ),
        array(
            'field' => 'cel',
            'label' => 'Celular',
            'rules' => 'trim'
        ),
        array(
            'field' => 'arraigo',
            'label' => 'Arraigp',
            'rules' => 'trim'
        ),
        array(
            'field' => 'problemas_acceso',
            'label' => 'Problemas acceso o vigencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'niv',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'datos_otros',
            'label' => 'Otro describir',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo',
            'label' => 'Trabajas Actualmente',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_nombre',
            'label' => 'Nombre de la empresa ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_puesto',
            'label' => 'Puesto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_domicilio',
            'label' => 'Domicilio completo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_ingreso',
            'label' => '',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_informante',
            'label' => 'Informante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_departamento',
            'label' => 'Departamento',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_piso',
            'label' => 'Piso',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_conyugue',
            'label' => 'Trabaja tu conyugue',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_giro',
            'label' => 'Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_nivel',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_Arraigo',
            'label' => 'arraigo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_telefono',
            'label' => 'Telefono Trabajo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_ext',
            'label' => 'Extencion',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_puesto2',
            'label' => 'Puesto Especifico',
            'rules' => 'trim'
        ),
        array(
            'field' => 'trabajo_area',
            'label' => 'Area',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_nom1',
            'label' => 'Referencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_nom2',
            'label' => 'Referencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_nom3',
            'label' => 'Referencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_tel1',
            'label' => 'Telefono',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_tel2',
            'label' => 'Telefono',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_tel3',
            'label' => 'Telefono',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rel1',
            'label' => 'Relacion',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rel2',
            'label' => 'Relacion',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rel3',
            'label' => 'Relacion',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_años1',
            'label' => 'Años',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_años2',
            'label' => 'Años',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_años3',
            'label' => 'Años',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rec1',
            'label' => 'Lo recomienda',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rec2',
            'label' => 'Lo recomienda',
            'rules' => 'trim'
        ),
        array(
            'field' => 'referencia_rec3',
            'label' => 'Lo recomienda',
            'rules' => 'trim'
        ),
        array(
            'field' => 'terminado',
            'label' => 'Terminado',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentario',
            'label' => 'Comentarios',
            'rules' => 'trim'
        ),
 
    ),
    'inv_padre' => array(
        array(
            'field' => 'padre_identi',
            'label' => 'Se identifico con',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_nom',
            'label' => 'NOMBRE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_civil',
            'label' => 'ESTADO CIVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_regimen',
            'label' => 'RÉGIMEN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_dependientes',
            'label' => 'DEPENDIENTES',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'padre_fecha',
            'label' => 'FECHA DE NACIMIENTO',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'padre_nacimiento',
            'label' => 'LUGAR DE NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_rfc',
            'label' => 'R.F.C',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_edad',
            'label' => 'EDAD',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'padre_calle',
            'label' => 'CALLE Y NÚMERO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_localidad',
            'label' => 'LOCALIDAD',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_tel',
            'label' => 'TELÉFONO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_mail',
            'label' => 'E-MAIL',
            'rules' => 'valid_email|trim'
        ),
        array(
            'field' => 'padre_correspondencia',
            'label' => 'Domicilio en el que se enviará la correspondencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_colonia',
            'label' => 'COLONIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_calles',
            'label' => 'ENTRE LAS CALLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_cel',
            'label' => 'CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_arraigo',
            'label' => 'ARRAIGO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_trabaja',
            'label' => 'Trabaja el Padre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_empresa',
            'label' => 'Nombre de la Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_puesto',
            'label' => 'Puesto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_trdom',
            'label' => 'Domicilio',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_ingreso',
            'label' => 'Ingreso Mensual Bruto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_verificacion',
            'label' => 'Verificación empleo, Informante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_tipoempresa',
            'label' => 'Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_nivel',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_trarraigo',
            'label' => 'Arraigo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'padre_trtelefono',
            'label' => 'Teléfono',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_identi',
            'label' => 'Se identifico con',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_nom',
            'label' => 'NOMBRE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_civil',
            'label' => 'ESTADO CIVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_regimen',
            'label' => 'RÉGIMEN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_dependientes',
            'label' => 'DEPENDIENTES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_fecha',
            'label' => 'FECHA DE NACIMIENTO Madre',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'madre_nacimiento',
            'label' => 'LUGAR DE NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_rfc',
            'label' => 'R.F.C',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_edad',
            'label' => 'EDAD',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'madre_calle',
            'label' => 'CALLE Y NÚMERO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_localidad',
            'label' => 'LOCALIDAD',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_tel',
            'label' => 'TELÉFONO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_mail',
            'label' => 'E-MAIL',
            'rules' => 'valid_email|trim'
        ),
        array(
            'field' => 'madre_correspondencia',
            'label' => 'Domicilio en el que se enviará la correspondencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_colonia',
            'label' => 'COLONIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_calles',
            'label' => 'ENTRE LAS CALLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_cel',
            'label' => 'CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_arraigo',
            'label' => ' ARRAIGO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_trabaja',
            'label' => 'Trabaja el Padre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_empresa',
            'label' => 'Nombre de la Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_puesto',
            'label' => 'Puesto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_trdom',
            'label' => 'Domicilio',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_ingreso',
            'label' => 'Ingreso Mensual Bruto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_verificacion',
            'label' => 'Verificación empleo, Informante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_tipoempresa',
            'label' => ' Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_nivel',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_trarraigo',
            'label' => 'Arraigo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'madre_trtelefono',
            'label' => 'Teléfono',
            'rules' => 'trim'
        )
    ),
    'inv_familiar' => array(
     
        array(
            'field' => 'hemano1',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hemano2',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hemano3',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hemano4',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hemano5',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanoedad1',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanoedad2',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanoedad3',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanoedad4',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanoedad5',
            'label' => 'Edad',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanocupacion1',
            'label' => 'Ocupación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanocupacion2',
            'label' => 'Ocupación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanocupacion3',
            'label' => 'Ocupación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanocupacion4',
            'label' => 'Ocupación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanocupacion5',
            'label' => 'Ocupación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanogrado1',
            'label' => 'Grado Escolar',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanogrado2',
            'label' => 'Grado Escolar',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanogrado3',
            'label' => 'Grado Escolar',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanogrado4',
            'label' => 'Grado Escolar',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanogrado5',
            'label' => 'Grado Escolar',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanoescuela1',
            'label' => 'Escuela',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanoescuela2',
            'label' => 'Escuela',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanoescuela3',
            'label' => 'Escuela',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanoescuela4',
            'label' => 'Escuela',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'hermanoescuela5',
            'label' => 'Escuela',
            'rules' => 'trim'
        ),
        array(
            'field' => 'hermanobeca1',
            'label' => '% de Beca',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanobeca2',
            'label' => '% de Beca',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanobeca3',
            'label' => '% de Beca',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanobeca4',
            'label' => '% de Beca',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'hermanobeca5',
            'label' => '% de Beca',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'descripcion1',
            'label' => 'AUTOMOVIL 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion2',
            'label' => 'AUTOMOVIL 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion3',
            'label' => 'AUTOMOVIL 3',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion4',
            'label' => 'COMPUTADORA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion5',
            'label' => 'LIBROS DE BIBLIOTECA PERSONAL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion6',
            'label' => 'MENSAJE DE CASA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion7',
            'label' => 'OTROS BIENES MUEBLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion8',
            'label' => 'BIENES INMUEBLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descripcion9',
            'label' => 'OTROS BIENES INMUEBLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor1',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor2',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor3',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor4',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor5',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor6',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor7',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor8',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valor9',
            'label' => 'VALOR APROX.',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'pagado1',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado2',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado3',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado5',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado7',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado8',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pagado9',
            'label' => 'PAGADO TOTALMENTE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo1',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo2',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo3',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo4',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo5',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo6',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo8',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo9',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'valortotal',
            'label' => 'VALOR TOTAL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'adeudo',
            'label' => 'ADEUDO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'diferencia',
            'label' => 'DIFERENCIA',
            'rules' => 'trim'
        ),  
        array(
            'field' => 'activo_descripcion1',
            'label' => 'Descripción',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_descripcion2',
            'label' => 'Descripción',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_Institución1',
            'label' => 'Institución',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_Institución2',
            'label' => 'Institución',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_titular1',
            'label' => 'Titular',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_titular2',
            'label' => 'Titular',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_ncuenta1',
            'label' => 'No. Cuenta',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_ncuenta2',
            'label' => 'No. Cuenta',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_monto1',
            'label' => 'Monto (MN)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'activo_monto2',
            'label' => 'Monto (MN)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'seguro1',
            'label' => 'SEGURO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'seguro2',
            'label' => 'SEGURO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'seguro3',
            'label' => 'SEGURO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'seguro4',
            'label' => 'SEGURO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'prima1',
            'label' => 'PRIMA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'prima2',
            'label' => 'PRIMA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'prima3',
            'label' => 'PRIMA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'prima4',
            'label' => 'PRIMA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'suma_asegurada',
            'label' => 'SUMA ASEGURADA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'suma_asegurada2',
            'label' => 'SUMA ASEGURADA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'suma_asegurada3',
            'label' => 'SUMA ASEGURADA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'suma_asegurada4',
            'label' => 'SUMA ASEGURADA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_descripcion1',
            'label' => 'Descripción',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_descripcion2',
            'label' => 'Descripción',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'pasivo_Institución1',
            'label' => 'Institución',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_Institución2',
            'label' => 'Institución',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_titular1',
            'label' => 'Titular',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_titular2',
            'label' => 'Titular',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_ncuenta1',
            'label' => 'No. Cuenta',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_ncuenta2',
            'label' => 'No. Cuenta',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_monto1',
            'label' => 'Monto (MN)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'pasivo_monto2',
            'label' => 'Monto (MN)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom1',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom2',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom3',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom4',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom5',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom6',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom7',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom8',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_nom9',
            'label' => 'Nombre',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco1',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco2',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco3',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco4',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco5',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco6',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco7',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'ingresos_parentesco8',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_parentesco9',
            'label' => 'Parentesco',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto1',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto2',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto3',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto4',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto5',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto6',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto7',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto8',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_concepto9',
            'label' => 'Concepto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual1',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual2',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual3',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual4',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual5',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual6',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual7',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual8',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_mensual9',
            'label' => '$ Mensual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'ingresos_total',
            'label' => ' Total de ingresos familiares',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen1',
            'label' => 'RENTA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen2',
            'label' => 'IMP PREDIAL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen3',
            'label' => 'AGUA',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'egresomen4',
            'label' => 'LUZ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen5',
            'label' => 'GAS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen6',
            'label' => 'TELÉFONO/CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen7',
            'label' => 'COLEGIATURAS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen8',
            'label' => 'INSCRIPCIONES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen9',
            'label' => 'CURSOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen10',
            'label' => 'UTILES ESCOLARES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen11',
            'label' => 'DE VIDA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen12',
            'label' => 'GASTOS MÉDICOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen13',
            'label' => 'DE AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen14',
            'label' => 'DE CASA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen15',
            'label' => 'TRANSPORTE PÚBLICO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen16',
            'label' => 'GASOLINA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen17',
            'label' => 'VERIFICACIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen18',
            'label' => 'TENENCIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen19',
            'label' => 'MTTO. AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen20',
            'label' => 'CLUB O DEPORTIVO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen21',
            'label' => 'DIVERSIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen22',
            'label' => 'VACACIONES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen23',
            'label' => 'TELEVISIÓN DE PAGA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen24',
            'label' => 'ROPA Y UNIFORMES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen25',
            'label' => 'TINTORERÍA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen26',
            'label' => 'AYUDA DOMÉSTICA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen27',
            'label' => 'MANTENIM. CASA',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'egresomen28',
            'label' => 'MÉDICOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen29',
            'label' => 'OTROS GASTOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen30',
            'label' => 'HIPOTECARIO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen31',
            'label' => 'AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen32',
            'label' => 'TARJETAS DE CRÉDITO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen33',
            'label' => 'PRÉSTAMOS PERS.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen34',
            'label' => 'COMPUTADORA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen35',
            'label' => 'COMPUTADORA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresomen36',
            'label' => 'TOTAL DE EGRESOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu1',
            'label' => 'RENTA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu2',
            'label' => 'IMP PREDIAL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu3',
            'label' => 'AGUA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu4',
            'label' => 'LUZ',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu5',
            'label' => 'GAS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu6',
            'label' => 'TELÉFONO/CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu7',
            'label' => 'COLEGIATURAS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu8',
            'label' => 'INSCRIPCIONES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu9',
            'label' => 'CURSOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu10',
            'label' => 'UTILES ESCOLARES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu11',
            'label' => 'DE VIDA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu12',
            'label' => 'GASTOS MÉDICOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu13',
            'label' => 'DE AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu14',
            'label' => 'DE CASA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu16',
            'label' => 'TRANSPORTE PÚBLICO',
            'rules' => 'trim'
        ),
        
        array(
            'field' => 'egresoanu17',
            'label' => 'GASOLINA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu18',
            'label' => 'VERIFICACIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu19',
            'label' => 'TENENCIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu20',
            'label' => 'MTTO. AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu21',
            'label' => 'CLUB O DEPORTIVO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu22',
            'label' => 'DIVERSIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu23',
            'label' => 'VACACIONES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu24',
            'label' => 'TELEVISIÓN DE PAGA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu25',
            'label' => 'ROPA Y UNIFORMES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu26',
            'label' => 'TINTORERÍA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu27',
            'label' => 'AYUDA DOMÉSTICA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu28',
            'label' => 'MANTENIM. CASA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu29',
            'label' => 'MÉDICOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu30',
            'label' => 'OTROS GASTOS',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu31',
            'label' => 'HIPOTECARIO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu32',
            'label' => 'AUTOMOVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu33',
            'label' => 'TARJETAS DE CRÉDITO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu34',
            'label' => 'PRÉSTAMOS PERS.',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu35',
            'label' => 'COMPUTADORA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'egresoanu36',
            'label' => 'TOTAL DE EGRESOS',
            'rules' => 'trim'
        )
    ),
    'inv_aval' => array(
        array(
            'field' => 'aval_identi1',
            'label' => 'Se identifico con',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_nom1',
            'label' => 'NOMBRE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_civil1',
            'label' => 'ESTADO CIVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_regimen1',
            'label' => 'RÉGIMEN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_dependientes1',
            'label' => 'DEPENDIENTES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_conyugue1',
            'label' => 'NOMBRE DEL CONYUGE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_fecha1',
            'label' => 'FECHA DE NACIMIENTO',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'aval_nacimiento1',
            'label' => 'LUGAR DE NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_rfc1',
            'label' => 'R.F.C',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_edad1',
            'label' => 'EDAD',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_calle1',
            'label' => 'CALLE Y NÚMERO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_delegacion1',
            'label' => 'MUNICIPIO ó DELEGACIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_cp1',
            'label' => 'C.P.',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_tel1',
            'label' => 'TELÉFONO',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_mail1',
            'label' => 'E-MAIL AVAL 1',
            'rules' => 'valid_email|trim'
        ),
        array(
            'field' => 'aval_correspondencia1',
            'label' => 'Domicilio en el que se enviará la correspondencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_relacion1',
            'label' => ' Relación con el solicitante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_colonia1',
            'label' => 'COLONIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_calles1',
            'label' => 'ENTRE LAS CALLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_estado1',
            'label' => 'ESTADO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_cel1',
            'label' => 'CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_arraigo1',
            'label' => 'ARRAIGO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_problema1',
            'label' => 'Problema acceso ó vigilancia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trabaja1',
            'label' => 'Trabaja el Aval',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_empresa1',
            'label' => 'Nombre de la Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_puesto1',
            'label' => 'Puesto especifico',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trdom1',
            'label' => 'Domicilio completo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_ingreso1',
            'label' => 'Ingreso Mensual Bruto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_verificacion1',
            'label' => 'Verificación empleo, Informante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_piso1',
            'label' => 'Piso',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_departamento1',
            'label' => 'Departamento',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_tipoempresa1',
            'label' => 'Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_nivel1',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trarraigo1',
            'label' => 'Arraigo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trtelefono1',
            'label' => 'Teléfono',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_ext1',
            'label' => 'Extensiones',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_area1',
            'label' => 'Área',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a11',
            'label' => 'No. de Serie:',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a21',
            'label' => 'No. de Factura',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a31',
            'label' => 'Marca',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a41',
            'label' => 'Tipo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a51',
            'label' => 'Modelo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a61',
            'label' => 'Placas',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a71',
            'label' => 'Aseguradora',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a81',
            'label' => 'Cobertura',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a91',
            'label' => 'Valor Comercial',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a101',
            'label' => 'Adeudo Actual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i11',
            'label' => 'Domicilio',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i21',
            'label' => 'Superficie del Terreno',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_i31',
            'label' => 'Construcción',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_i41',
            'label' => 'Edo. de Conservación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i51',
            'label' => 'Registro Público',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i61',
            'label' => 'Gravámenes',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i71',
            'label' => 'Acreedor',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i81',
            'label' => 'Propietario',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i91',
            'label' => 'Valor Comercial',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i101',
            'label' => 'Adeudo Actual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_identi2',
            'label' => 'Se identifico con',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_nom2',
            'label' => 'NOMBRE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_civil2',
            'label' => 'ESTADO CIVIL',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_regimen2',
            'label' => 'RÉGIMEN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_dependientes2',
            'label' => 'DEPENDIENTES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_conyugue2',
            'label' => 'NOMBRE DEL CONYUGE',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_fecha2',
            'label' => 'FECHA DE NACIMIENTO',
            'rules' => 'valida_fechas_esp|trim'
        ),
        array(
            'field' => 'aval_nacimiento2',
            'label' => 'LUGAR DE NACIMIENTO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_rfc2',
            'label' => 'R.F.C',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_edad2',
            'label' => 'EDAD',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_calle2',
            'label' => 'CALLE Y NÚMERO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_delegacion2',
            'label' => 'MUNICIPIO ó DELEGACIÓN',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_cp2',
            'label' => 'C.P.',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_tel2',
            'label' => 'TELÉFONO',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_mail2',
            'label' => 'E-MAIL AVAL 2',
            'rules' => 'valid_email|trim'
        ),
        array(
            'field' => 'aval_correspondencia2',
            'label' => 'Domicilio en el que se enviará la correspondencia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_relacion2',
            'label' => ' Relación con el solicitante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_colonia2',
            'label' => 'COLONIA',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_calles2',
            'label' => 'ENTRE LAS CALLES',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_estado2',
            'label' => 'ESTADO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_cel2',
            'label' => 'CELULAR',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_arraigo2',
            'label' => 'ARRAIGO',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_problema2',
            'label' => 'Problema acceso ó vigilancia',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trabaja2',
            'label' => 'Trabaja el Aval',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_empresa2',
            'label' => 'Nombre de la Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_puesto2',
            'label' => 'Puesto especifico',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trdom2',
            'label' => 'Domicilio completo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_ingreso2',
            'label' => 'Ingreso Mensual Bruto',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_verificacion2',
            'label' => 'Verificación empleo, Informante',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_piso2',
            'label' => 'Piso',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_departamento2',
            'label' => 'Departamento',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_tipoempresa2',
            'label' => 'Empresa',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_nivel2',
            'label' => 'Nivel',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trarraigo2',
            'label' => 'Arraigo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_trtelefono2',
            'label' => 'Teléfono',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_ext2',
            'label' => 'Extensiones',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_area2',
            'label' => 'Área',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a12',
            'label' => 'No. de Serie:',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a22',
            'label' => 'No. de Factura',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a32',
            'label' => 'Marca',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a42',
            'label' => 'Tipo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a52',
            'label' => 'Modelo',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a62',
            'label' => 'Placas',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a72',
            'label' => 'Aseguradora',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a82',
            'label' => 'Cobertura',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a92',
            'label' => 'Valor Comercial',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_a102',
            'label' => 'Adeudo Actual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i12',
            'label' => 'Domicilio',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i22',
            'label' => 'Superficie del Terreno',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_i32',
            'label' => 'Construcción',
            'rules' => 'numeric|trim'
        ),
        array(
            'field' => 'aval_i42',
            'label' => 'Edo. de Conservación',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i52',
            'label' => 'Registro Público',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i62',
            'label' => 'Gravámenes',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i72',
            'label' => 'Acreedor',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i82',
            'label' => 'Propietario',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i92',
            'label' => 'Valor Comercial',
            'rules' => 'trim'
        ),
        array(
            'field' => 'aval_i102',
            'label' => 'Adeudo Actual',
            'rules' => 'trim'
        ),
        array(
            'field' => 'comentarios',
            'label' => 'Comenterios',
            'rules' => 'trim'
        ),
        array(
            'field' => 'investigador_nom',
            'label' => 'Nombre (s)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'investigador_paterno',
            'label' => 'Apellido Paterno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'investigador_materno',
            'label' => 'Apellido Materno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'iresponsable_nom',
            'label' => 'Nombre (s)',
            'rules' => 'trim'
        ),
        array(
            'field' => 'iresponsable_paterno',
            'label' => 'Apellido Paterno',
            'rules' => 'trim'
        ),
        array(
            'field' => 'iresponsable_materno',
            'label' => 'Apellido Materno',
            'rules' => 'trim'
        )   
    ),
    'cambiar_matricula' => array(
        array(
            'field' => 'exp',
            'label' => 'ID Expediente',
            'rules' => 'required|trim|greater_than[0]'
        ),
        array(
            'field' => 'matricula_new',
            'label' => 'Nueva Matrícula',
            'rules' => 'required|callback__unique_matricula|trim'
        ),
        array(
            'field' => 'comentario',
            'label' => 'Comentario',
            'rules' => 'required|trim'
        )
    ),
    'reporte_contrato' => array(
        array(
            'field' => 'mat[]',
            'label' => 'Matrículas',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'mes[]',
            'label' => 'Meses',
            'rules' => 'required|trim'
        )
    ),
    'inv_foto' => array(
        array(
            'field' => 'descrip1',
            'label' => 'Descripción 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descrip2',
            'label' => 'Descripción 2',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descrip3',
            'label' => 'Descripción 3',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descrip4',
            'label' => 'Descripción 4',
            'rules' => 'trim'
        ),
        array(
            'field' => 'descrip5',
            'label' => 'Descripción 5',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mapa1',
            'label' => 'Mapa 1',
            'rules' => 'trim'
        ),
        array(
            'field' => 'mapa2',
            'label' => 'Mapa 2',
            'rules' => 'trim'
        )
    ),
    'reporte_mesa' => array(
        array(
            'field' => 'fechaini',
            'label' => 'Fecha de Inicio',
            'rules' => 'required|valida_fechas_esp|trim'
        ),
        array(
            'field' => 'fechafin',
            'label' => 'Fecha Fin',
            'rules' => 'required|valida_fechas_esp|trim'
        )
    ),
    'tabla_global' => array(
        array(
            'field' => 'formhid',
            'label' => 'Formhid',
            'rules' => 'required'
        )
    ),
    'pagare2_rules' => array(
        array(
            'field' => 'importe',
            'label' => 'Importe',
            'rules' => 'required|callback__menor_a_disposicion'
        ),
        array(
            'field' => 'plazo',
            'label' => 'Plazo',
            'rules' => 'numeric'
        ),
        array(
            'field' => 'fecha_suscripcion',
            'label' => 'Fecha de Suscripción',
            'rules' => 'required|valida_fechas_esp'
        )
    ),
    'borrar_pagare' => array(
        array(
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'required|greater_than[0]'
        ),
        array(
            'field' => 'id',
            'label' => 'ID',
            'rules' => 'required|greater_than[0]'
        ),
        array(
            'field' => 'exp',
            'label' => 'expediente',
            'rules' => 'required|greater_than[0]'
        ),
        array(
            'field' => 'comentario',
            'label' => 'Motivos',
            'rules' => 'required'
        )
    ),
    'cambiar_linea' => array(
        array(
            'field' => 'linea',
            'label' => 'Línea Autorizada',
            'rules' => 'required'
        ),
        array(
            'field' => 'expediente',
            'label' => 'ID Expediente',
            'rules' => 'required|numeric'
        )
    ),
    'ampliar_linea' => array(
        array(
            'field' => 'linea',
            'label' => 'Nueva Línea Global',
            'rules' => 'required|callback__menor_a_prestado'
        ),
        array(
            'field' => 'pago',
            'label' => 'Nuevo Pago Mensual',
            'rules' => 'required'
        ),
        array(
            'field' => 'expediente',
            'label' => 'ID Expediente',
            'rules' => 'required|numeric'
        )
    )
);