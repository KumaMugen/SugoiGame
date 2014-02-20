<?php
	//formatos de valores
	define('ALL_FORMAT',"//");
	define('STR_FORMAT',"/^[\w]+$/");
	define('INT_FORMAT',"/^[\d]+$/");
	define('EMAIL_FORMAT',"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/");
	define('EMAIL_FORMAT_2',"/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/");
	define('DATA_FORMAT',"/^\d{4}-\d{1,2}-\d{1,2}$/");
	define('COORD_FORMAT',"/^\d{1,3}_\d{1,3}$/");
	
	//multiplicadores globais
	define('RATE_XP',1); //EXP
	define('RATE_DROP',1); //Drop de itens
	define('RATE_BERRIES',1); //Ganho de Berries
	define('RATE_REPUTACAO',1); //Ganho de Reputação
	define('RATE_GOLD',1); //Ganho de Ouro
	
	//Quantidades
	define('QNT_PERSONAGENS',310);
	define('QNT_SKILS',160);
	
	//zonas restritas
	define('PER_sistemaHome',1); //quem tem acesso: x pra baixo
	define('PER_sistemaAkuma',1);
	define('PER_sistemaRestricoes',0);
	define('PER_sistemaIlhas',1);
	define('PER_sistemaMissoes',1);
	define('PER_sistemaNPC',0);
	define('PER_sistemaItens',0);
	
	//spans de combate
	define('SPAN_BLOQUEIO',' <span class="bloqueou">Bloqueou</span>');
	define('SPAN_ESQUIVA',' <span class="esquivou">Esquivou</span>');
	define('SPAN_CRITICO',' <span class="critou">Ataque Crítico</span>');
	define('SPAN_DERROTADO',' e foi <span class="derrotado">Derrotado</span>');
	
	//Unidades de medida em metros e segundos
	define('VEL_NO',0.514);
	define('TAM_QUADRO',155);
	
	//constantes de combate
	define('TEMPO_TURNO',90);
	define('MOVIMENTOS_TURNO',5);
	
	//Portas
	define('PORTA_CHAT',888);