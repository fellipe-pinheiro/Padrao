--Esta query soma as quantidades se as datas forem iguais
select pedido_id,orcamento_id,produto_id,produto_nome,SUM(quantidade) as quantidade,data_entrega from (
	SELECT ped.id as pedido_id,orc.id as orcamento_id,orc_conv.id as produto_id,conv_mod.nome as produto_nome,orc_conv.quantidade,orc_conv.data_entrega,orc_conv.cancelado FROM `pedido` as ped 
	inner join orcamento as orc on ped.orcamento=orc.id
	inner join orcamento_convite as orc_conv on orc_conv.orcamento=orc.id
	inner join convite as c on c.id=orc_conv.convite
	inner join convite_modelo as conv_mod on conv_mod.id=c.modelo
	where orc_conv.cancelado=0
	UNION all
	select ad.pedido as pedido_id,ped.orcamento as orcamento_id,orc_conv.id as produto_id,conv_mod.nome as produto_nome,ad_c.quantidade,ad_c.data_entrega,ad_c.cancelado from adicional as ad 
	inner join pedido as ped on ad.pedido=ped.id
	inner join adicional_convite as ad_c on ad_c.adicional=ad.id
	inner join orcamento_convite as orc_conv on orc_conv.id=ad_c.orcamento_convite
	inner join convite as c on c.id=orc_conv.convite
	inner join convite_modelo as conv_mod on conv_mod.id=c.modelo
	where ad_c.cancelado=0

	UNION all

	SELECT ped.id as pedido_id,orc.id as orcamento_id,orc_pers.id  as produto_id,pers_mod.nome as produto_nome,orc_pers.quantidade,orc_pers.data_entrega,orc_pers.cancelado FROM `pedido` as ped 
	inner join orcamento as orc on ped.orcamento=orc.id
	inner join orcamento_personalizado as orc_pers on orc_pers.orcamento=orc.id
	inner join personalizado_produto as pers_prod on pers_prod.id=orc_pers.personalizado_produto
	inner join personalizado_modelo as pers_mod on pers_mod.id=pers_prod.modelo
	where orc_pers.cancelado=0
	UNION all 
	select ad.pedido as pedido_id,ped.orcamento as orcamento_id,orc_pers.id as produto_id,pers_mod.nome as produto_nome,ad_pers.quantidade,ad_pers.data_entrega,ad_pers.cancelado from adicional as ad 
	inner join pedido as ped on ad.pedido=ped.id
	inner join adicional_personalizado as ad_pers on ad_pers.adicional=ad.id
	inner join orcamento_personalizado as orc_pers on orc_pers.id=ad_pers.orcamento_personalizado
	inner join personalizado_produto as pers_prod on pers_prod.id=orc_pers.personalizado_produto
	inner join personalizado_modelo as pers_mod on pers_mod.id=pers_prod.modelo
	where ad_pers.cancelado=0
	UNION all

	SELECT ped.id as pedido_id,orc.id as orcamento_id,orc_prod.id as produto_id,prod.nome as produto_nome,orc_prod.quantidade,orc_prod.data_entrega,orc_prod.cancelado FROM `pedido` as ped 
	inner join orcamento as orc on ped.orcamento=orc.id
	inner join orcamento_produto as orc_prod on orc_prod.orcamento=orc.id
	inner join produto as prod on prod.id=orc_prod.produto
	where orc_prod.cancelado=0
	UNION all 
	SELECT ad.pedido as pedido_id,ped.orcamento as orcamento_id,orc_prod.id as produto_id,prod.nome as produto_nome,ad_prod.quantidade,ad_prod.data_entrega,ad_prod.cancelado FROM adicional as ad 
	inner join pedido as ped on ad.pedido=ped.id
	inner join adicional_produto as ad_prod on ad_prod.adicional=ad.id
	inner join orcamento_produto as orc_prod on orc_prod.id=ad_prod.orcamento_produto
	inner join produto as prod on prod.id=orc_prod.produto
	where ad_prod.cancelado=0
) as q 
GROUP by pedido_id,orcamento_id,produto_id,produto_nome,data_entrega

studio_cg.mysql.dbaas.com.br

CREATE 
ALGORITHM = UNDEFINED 
DEFINER = `studio_cg`@`%%` 
SQL SECURITY DEFINER
VIEW `v_produtos_entrega` AS
SELECT 
`ped`.`id` AS `pedido_id`,
`orc`.`id` AS `orcamento_id`,
`orc_conv`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
`conv_mod`.`nome` AS `produto_nome`,
`orc_conv`.`quantidade` AS `quantidade`,
`orc_conv`.`data_entrega` AS `data_entrega`,
`orc_conv`.`cancelado` AS `cancelado`
FROM
((((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`orcamento` = `orc`.`id`)))
JOIN `convite` `c` ON ((`c`.`id` = `orc_conv`.`convite`)))
JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `c`.`modelo`)))
WHERE
(`orc_conv`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_conv`.`orcamento_convite` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_conv`.`id` AS `ad_produto_id`,
`conv_mod`.`nome` AS `produto_nome`,
`ad_conv`.`quantidade` AS `quantidade`,
`ad_conv`.`data_entrega` AS `data_entrega`,
`ad_conv`.`cancelado` AS `cancelado`
FROM
(((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_convite` `ad_conv` ON ((`ad_conv`.`adicional` = `ad`.`id`)))
JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`)))
JOIN `convite` `c` ON ((`c`.`id` = `orc_conv`.`convite`)))
JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `c`.`modelo`)))
WHERE
(`ad_conv`.`cancelado` = 0) 
UNION ALL SELECT 
`ped`.`id` AS `pedido_id`,
`orc`.`id` AS `orcamento_id`,
`orc_pers`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
`pers_mod`.`nome` AS `produto_nome`,
`orc_pers`.`quantidade` AS `quantidade`,
`orc_pers`.`data_entrega` AS `data_entrega`,
`orc_pers`.`cancelado` AS `cancelado`
FROM
((((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_personalizado` `orc_pers` ON ((`orc_pers`.`orcamento` = `orc`.`id`)))
JOIN `personalizado_produto` `pers_prod` ON ((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`)))
JOIN `personalizado_modelo` `pers_mod` ON ((`pers_mod`.`id` = `pers_prod`.`modelo`)))
WHERE
(`orc_pers`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_pers`.`orcamento_personalizado` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_pers`.`id` AS `ad_produto_id`,
`pers_mod`.`nome` AS `produto_nome`,
`ad_pers`.`quantidade` AS `quantidade`,
`ad_pers`.`data_entrega` AS `data_entrega`,
`ad_pers`.`cancelado` AS `cancelado`
FROM
(((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_personalizado` `ad_pers` ON ((`ad_pers`.`adicional` = `ad`.`id`)))
JOIN `orcamento_personalizado` `orc_pers` ON ((`orc_pers`.`id` = `ad_pers`.`orcamento_personalizado`)))
JOIN `personalizado_produto` `pers_prod` ON ((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`)))
JOIN `personalizado_modelo` `pers_mod` ON ((`pers_mod`.`id` = `pers_prod`.`modelo`)))
WHERE
(`ad_pers`.`cancelado` = 0) 
UNION ALL SELECT 
`ped`.`id` AS `pedido_id`,
`orc`.`id` AS `orcamento_id`,
`orc_prod`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
`prod`.`nome` AS `produto_nome`,
`orc_prod`.`quantidade` AS `quantidade`,
`orc_prod`.`data_entrega` AS `data_entrega`,
`orc_prod`.`cancelado` AS `cancelado`
FROM
(((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_produto` `orc_prod` ON ((`orc_prod`.`orcamento` = `orc`.`id`)))
JOIN `produto` `prod` ON ((`prod`.`id` = `orc_prod`.`produto`)))
WHERE
(`orc_prod`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_prod`.`orcamento_produto` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_prod`.`id` AS `ad_produto_id`,
`prod`.`nome` AS `produto_nome`,
`ad_prod`.`quantidade` AS `quantidade`,
`ad_prod`.`data_entrega` AS `data_entrega`,
`ad_prod`.`cancelado` AS `cancelado`
FROM
((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_produto` `ad_prod` ON ((`ad_prod`.`adicional` = `ad`.`id`)))
JOIN `orcamento_produto` `orc_prod` ON ((`orc_prod`.`id` = `ad_prod`.`orcamento_produto`)))
JOIN `produto` `prod` ON ((`prod`.`id` = `orc_prod`.`produto`)))
WHERE
(`ad_prod`.`cancelado` = 0)



CREATE 
ALGORITHM = UNDEFINED 
DEFINER = `studio_cg`@`%%` 
SQL SECURITY DEFINER
VIEW `v_calendario_entrega` AS
SELECT 
`v`.`pedido_id` AS `pedido_id`,
`v`.`orcamento_id` AS `orcamento_id`,
`v`.`produto_id` AS `produto_id`,
`v`.`adicional` AS `adicional`,
`v`.`adicional_id` AS `adicional_id`,
`v`.`ad_produto_id` AS `ad_produto_id`,
`v`.`produto_nome` AS `produto_nome`,
`v`.`quantidade` AS `quantidade`,
`v`.`data_entrega` AS `data_entrega`,
`cli`.`id` AS `cliente_id`,
CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`
FROM
((`v_produtos_entrega_ativo` `v`
	LEFT JOIN `orcamento` `o` ON ((`o`.`id` = `v`.`orcamento_id`)))
LEFT JOIN `cliente` `cli` ON ((`cli`.`id` = `o`.`cliente`)))







CREATE 
ALGORITHM = UNDEFINED 
DEFINER = `studio_cg`@`%%` 
SQL SECURITY DEFINER
VIEW `v_produtos_entrega_ativo` AS
SELECT 
`ped`.`id` AS `pedido_id`,
'pedido' AS `documento`,
`orc`.`id` AS `orcamento_id`,
`orc_conv`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
'convite' AS `produto_tipo`,
`conv_mod`.`nome` AS `produto_nome`,
`conv_mod`.`codigo` AS `produto_codigo`,
`orc_conv`.`quantidade` AS `quantidade`,
`orc_conv`.`data_entrega` AS `data_entrega`,
`orc_conv`.`cancelado` AS `cancelado`
FROM
((((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`orcamento` = `orc`.`id`)))
JOIN `convite` `c` ON ((`c`.`id` = `orc_conv`.`convite`)))
JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `c`.`modelo`)))
WHERE
(`orc_conv`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
'adicional' AS `documento`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_conv`.`orcamento_convite` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_conv`.`id` AS `ad_produto_id`,
'convite' AS `produto_tipo`,
`conv_mod`.`nome` AS `produto_nome`,
`conv_mod`.`codigo` AS `produto_codigo`,
`ad_conv`.`quantidade` AS `quantidade`,
`ad_conv`.`data_entrega` AS `data_entrega`,
`ad_conv`.`cancelado` AS `cancelado`
FROM
(((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_convite` `ad_conv` ON ((`ad_conv`.`adicional` = `ad`.`id`)))
JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`)))
JOIN `convite` `c` ON ((`c`.`id` = `orc_conv`.`convite`)))
JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `c`.`modelo`)))
WHERE
(`ad_conv`.`cancelado` = 0) 
UNION ALL SELECT 
`ped`.`id` AS `pedido_id`,
'pedido' AS `documento`,
`orc`.`id` AS `orcamento_id`,
`orc_pers`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
'personalizado' AS `produto_tipo`,
`pers_mod`.`nome` AS `produto_nome`,
`pers_mod`.`codigo` AS `produto_codigo`,
`orc_pers`.`quantidade` AS `quantidade`,
`orc_pers`.`data_entrega` AS `data_entrega`,
`orc_pers`.`cancelado` AS `cancelado`
FROM
((((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_personalizado` `orc_pers` ON ((`orc_pers`.`orcamento` = `orc`.`id`)))
JOIN `personalizado_produto` `pers_prod` ON ((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`)))
JOIN `personalizado_modelo` `pers_mod` ON ((`pers_mod`.`id` = `pers_prod`.`modelo`)))
WHERE
(`orc_pers`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
'adicional' AS `documento`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_pers`.`orcamento_personalizado` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_pers`.`id` AS `ad_produto_id`,
'personalizado' AS `produto_tipo`,
`pers_mod`.`nome` AS `produto_nome`,
`pers_mod`.`codigo` AS `produto_codigo`,
`ad_pers`.`quantidade` AS `quantidade`,
`ad_pers`.`data_entrega` AS `data_entrega`,
`ad_pers`.`cancelado` AS `cancelado`
FROM
(((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_personalizado` `ad_pers` ON ((`ad_pers`.`adicional` = `ad`.`id`)))
JOIN `orcamento_personalizado` `orc_pers` ON ((`orc_pers`.`id` = `ad_pers`.`orcamento_personalizado`)))
JOIN `personalizado_produto` `pers_prod` ON ((`pers_prod`.`id` = `orc_pers`.`personalizado_produto`)))
JOIN `personalizado_modelo` `pers_mod` ON ((`pers_mod`.`id` = `pers_prod`.`modelo`)))
WHERE
(`ad_pers`.`cancelado` = 0) 
UNION ALL SELECT 
`ped`.`id` AS `pedido_id`,
'pedido' AS `documento`,
`orc`.`id` AS `orcamento_id`,
`orc_prod`.`id` AS `produto_id`,
0 AS `adicional`,
NULL AS `adicional_id`,
NULL AS `ad_produto_id`,
'produto' AS `produto_tipo`,
`prod`.`nome` AS `produto_nome`,
NULL AS `produto_codigo`,
`orc_prod`.`quantidade` AS `quantidade`,
`orc_prod`.`data_entrega` AS `data_entrega`,
`orc_prod`.`cancelado` AS `cancelado`
FROM
(((`pedido` `ped`
	JOIN `orcamento` `orc` ON ((`ped`.`orcamento` = `orc`.`id`)))
JOIN `orcamento_produto` `orc_prod` ON ((`orc_prod`.`orcamento` = `orc`.`id`)))
JOIN `produto` `prod` ON ((`prod`.`id` = `orc_prod`.`produto`)))
WHERE
(`orc_prod`.`cancelado` = 0) 
UNION ALL SELECT 
`ad`.`pedido` AS `pedido_id`,
'adicional' AS `documento`,
`ped`.`orcamento` AS `orcamento_id`,
`ad_prod`.`orcamento_produto` AS `produto_id`,
1 AS `adicional`,
`ad`.`id` AS `adicional_id`,
`ad_prod`.`id` AS `ad_produto_id`,
'produto' AS `produto_tipo`,
`prod`.`nome` AS `produto_nome`,
NULL AS `produto_codigo`,
`ad_prod`.`quantidade` AS `quantidade`,
`ad_prod`.`data_entrega` AS `data_entrega`,
`ad_prod`.`cancelado` AS `cancelado`
FROM
((((`adicional` `ad`
	JOIN `pedido` `ped` ON ((`ad`.`pedido` = `ped`.`id`)))
JOIN `adicional_produto` `ad_prod` ON ((`ad_prod`.`adicional` = `ad`.`id`)))
JOIN `orcamento_produto` `orc_prod` ON ((`orc_prod`.`id` = `ad_prod`.`orcamento_produto`)))
JOIN `produto` `prod` ON ((`prod`.`id` = `orc_prod`.`produto`)))
WHERE
(`ad_prod`.`cancelado` = 0);




CREATE 
ALGORITHM = UNDEFINED 
DEFINER = `studio_cg`@`%%` 
SQL SECURITY DEFINER
VIEW `v_calendario_entrega` AS
SELECT 
`v`.`pedido_id` AS `pedido_id`,
`v`.`documento` AS `documento`,
`v`.`orcamento_id` AS `orcamento_id`,
`v`.`produto_id` AS `produto_id`,
`v`.`adicional` AS `adicional`,
`v`.`adicional_id` AS `adicional_id`,
`v`.`ad_produto_id` AS `ad_produto_id`,
`v`.`produto_tipo` AS `produto_tipo`,
`v`.`produto_nome` AS `produto_nome`,
`v`.`produto_codigo` AS `produto_codigo`,
`v`.`quantidade` AS `quantidade`,
`v`.`data_entrega` AS `data_entrega`,
`cli`.`id` AS `cliente_id`,
CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`,
`orc`.`data_evento` AS `data_evento`,
`loj`.`unidade` AS `unidade`,
`v`.`recebimento_dados` AS `recebimento_dados`,
`v`.`desenvolvimento_layout` AS `desenvolvimento_layout`,
`v`.`envio_layout` AS `envio_layout`,
`v`.`aprovado` AS `aprovado`,
`v`.`producao` AS `producao`,
`v`.`disponivel` AS `disponivel`,
`v`.`retirado` AS `retirado`
FROM
(((`v_produtos_entrega_ativo` `v`
	LEFT JOIN `orcamento` `orc` ON ((`orc`.`id` = `v`.`orcamento_id`)))
LEFT JOIN `cliente` `cli` ON ((`cli`.`id` = `orc`.`cliente`)))
LEFT JOIN `loja` `loj` ON ((`loj`.`id` = `orc`.`loja`)))


--Retorna um agrupamento somando a quantidade
SELECT 
pedido_id,orcamento_id,produto_id,produto_tipo,produto_nome,
produto_codigo,SUM(quantidade) as quantidade,data_entrega,
cliente_id,cliente,data_evento,producao,disponivel,retirado
FROM
v_calendario_entrega
WHERE pedido_id = 69
AND producao IS NULL
AND disponivel IS NULL
AND retirado IS NULL
GROUP by
pedido_id,orcamento_id,produto_id,produto_tipo,produto_nome,
produto_codigo,data_entrega,
cliente_id,cliente,data_evento


--Lista de compra de papeis
SELECT 
ped.id as pedido,
cli.id as cliente_id,
concat(cli.nome," ",cli.sobrenome ) as cliente,
orc.data_evento,
orc_conv.id as produto_id,
orc_conv.quantidade as qtd_pedido,
orc_conv.data_entrega,
cart_pap.quantidade as papel_qtd,
cart_pap.gramatura as papel_gram,
pap.id as papel_id,
pap.nome as papel,
pap_lin.nome as papel_linha,
pap_cat.nome as papel_categoria,
pap_dim.altura as pap_inteiro_alt,
pap_dim.largura as pap_inteiro_larg,
conv_mod.codigo as modelo_codigo,
conv_mod.nome as modelo_nome,
conv_mod.cartao_altura as altura_final,
conv_mod.cartao_largura as larguar_final,
conv_mod.empastamento_borda as empastamento_borda,
0 AS adicional,
NULL AS adicional_id,
NULL AS ad_produto_id,
'convite' AS produto_tipo

FROM orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = orc_conv.orcamento
inner join cliente as cli on cli.id = orc.cliente
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao
inner join papel as pap on  pap.id = cart_pap.papel
inner join papel_linha as pap_lin on  pap_lin.id = pap.papel_linha
inner join papel_catalogo as pap_cat on pap_cat.id = pap_lin.papel_catalogo
inner join papel_dimensao as pap_dim on pap_dim.id = pap.papel_dimensao
inner join convite_modelo as conv_mod on conv_mod.id = conv.modelo

UNION all

SELECT 
ped.id as pedido,
cli.id as cliente_id,
concat(cli.nome," ",cli.sobrenome ) as cliente,
orc.data_evento,
ad_conv.orcamento_convite as produto_id,
ad_conv.quantidade as qtd_pedido,
ad_conv.data_entrega,
cart_pap.quantidade as papel_qtd,
cart_pap.gramatura as papel_gram,
pap.id as papel_id,
pap.nome as papel,
pap_lin.nome as papel_linha,
pap_cat.nome as papel_categoria,
pap_dim.altura as pap_inteiro_alt,
pap_dim.largura as pap_inteiro_larg,
conv_mod.codigo as modelo_codigo,
conv_mod.nome as modelo_nome,
conv_mod.cartao_altura as altura_final,
conv_mod.cartao_largura as larguar_final,
conv_mod.empastamento_borda as empastamento_borda,
1 AS adicional,
ad.id AS adicional_id,
ad_conv.id AS ad_produto_id,
'convite' AS produto_tipo

FROM adicional_convite as ad_conv
inner join adicional as ad on ad.id = ad_conv.adicional

inner join orcamento_convite as orc_conv on orc_conv.id = ad_conv.orcamento_convite
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = orc_conv.orcamento
inner join cliente as cli on cli.id = orc.cliente
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao
inner join papel as pap on  pap.id = cart_pap.papel
inner join papel_linha as pap_lin on  pap_lin.id = pap.papel_linha
inner join papel_catalogo as pap_cat on pap_cat.id = pap_lin.papel_catalogo
inner join papel_dimensao as pap_dim on pap_dim.id = pap.papel_dimensao
inner join convite_modelo as conv_mod on conv_mod.id = conv.modelo

CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `v_lista_compra_papel` AS
    SELECT 
        `ped`.`id` AS `pedido`,
        `cli`.`id` AS `cliente_id`,
        CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`,
        `orc`.`data_evento` AS `data_evento`,
        `orc_conv`.`id` AS `produto_id`,
        `orc_conv`.`quantidade` AS `qtd_pedido`,
        `orc_conv`.`data_entrega` AS `data_entrega`,
        `cart_pap`.`gramatura` AS `gramatura`,
        `cart_pap`.`quantidade` AS `qtd_papel`,
        `pap`.`id` AS `papel_id`,
        `pap`.`nome` AS `papel`,
        `pap_lin`.`nome` AS `papel_linha`,
        `pap_cat`.`nome` AS `papel_categoria`,
        `pap_dim`.`altura` AS `pap_inteiro_alt`,
        `pap_dim`.`largura` AS `pap_inteiro_larg`,
        `conv_mod`.`codigo` AS `modelo_codigo`,
        `conv_mod`.`nome` AS `modelo_nome`,
        `conv_mod`.`cartao_altura` AS `altura_final`,
        `conv_mod`.`cartao_largura` AS `larguar_final`,
        `conv_mod`.`empastamento_borda` AS `empastamento_borda`,
        0 AS `adicional`,
        NULL AS `adicional_id`,
        NULL AS `ad_produto_id`,
        'convite' AS `produto_tipo`,
        'cartao' AS `composicao`
    FROM
        ((((((((((`orcamento_convite` `orc_conv`
        JOIN `pedido` `ped` ON ((`ped`.`orcamento` = `orc_conv`.`orcamento`)))
        JOIN `orcamento` `orc` ON ((`orc`.`id` = `orc_conv`.`orcamento`)))
        JOIN `cliente` `cli` ON ((`cli`.`id` = `orc`.`cliente`)))
        JOIN `convite` `conv` ON ((`conv`.`id` = `orc_conv`.`convite`)))
        JOIN `cartao_papel` `cart_pap` ON ((`cart_pap`.`cartao` = `conv`.`cartao`)))
        JOIN `papel` `pap` ON ((`pap`.`id` = `cart_pap`.`papel`)))
        JOIN `papel_linha` `pap_lin` ON ((`pap_lin`.`id` = `pap`.`papel_linha`)))
        JOIN `papel_catalogo` `pap_cat` ON ((`pap_cat`.`id` = `pap_lin`.`papel_catalogo`)))
        JOIN `papel_dimensao` `pap_dim` ON ((`pap_dim`.`id` = `pap`.`papel_dimensao`)))
        JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `conv`.`modelo`))) 
    UNION ALL SELECT 
        `ped`.`id` AS `pedido`,
        `cli`.`id` AS `cliente_id`,
        CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`,
        `orc`.`data_evento` AS `data_evento`,
        `ad_conv`.`orcamento_convite` AS `produto_id`,
        `ad_conv`.`quantidade` AS `qtd_pedido`,
        `ad_conv`.`data_entrega` AS `data_entrega`,
        `cart_pap`.`gramatura` AS `gramatura`,
        `cart_pap`.`quantidade` AS `qtd_papel`,
        `pap`.`id` AS `papel_id`,
        `pap`.`nome` AS `papel`,
        `pap_lin`.`nome` AS `papel_linha`,
        `pap_cat`.`nome` AS `papel_categoria`,
        `pap_dim`.`altura` AS `pap_inteiro_alt`,
        `pap_dim`.`largura` AS `pap_inteiro_larg`,
        `conv_mod`.`codigo` AS `modelo_codigo`,
        `conv_mod`.`nome` AS `modelo_nome`,
        `conv_mod`.`cartao_altura` AS `altura_final`,
        `conv_mod`.`cartao_largura` AS `larguar_final`,
        `conv_mod`.`empastamento_borda` AS `empastamento_borda`,
        1 AS `adicional`,
        `ad`.`id` AS `adicional_id`,
        `ad_conv`.`id` AS `ad_produto_id`,
        'convite' AS `produto_tipo`,
        'cartao' AS `composicao`
    FROM
        ((((((((((((`adicional_convite` `ad_conv`
        JOIN `adicional` `ad` ON ((`ad`.`id` = `ad_conv`.`adicional`)))
        JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`)))
        JOIN `pedido` `ped` ON ((`ped`.`orcamento` = `orc_conv`.`orcamento`)))
        JOIN `orcamento` `orc` ON ((`orc`.`id` = `orc_conv`.`orcamento`)))
        JOIN `cliente` `cli` ON ((`cli`.`id` = `orc`.`cliente`)))
        JOIN `convite` `conv` ON ((`conv`.`id` = `orc_conv`.`convite`)))
        JOIN `cartao_papel` `cart_pap` ON ((`cart_pap`.`cartao` = `conv`.`cartao`)))
        JOIN `papel` `pap` ON ((`pap`.`id` = `cart_pap`.`papel`)))
        JOIN `papel_linha` `pap_lin` ON ((`pap_lin`.`id` = `pap`.`papel_linha`)))
        JOIN `papel_catalogo` `pap_cat` ON ((`pap_cat`.`id` = `pap_lin`.`papel_catalogo`)))
        JOIN `papel_dimensao` `pap_dim` ON ((`pap_dim`.`id` = `pap`.`papel_dimensao`)))
        JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `conv`.`modelo`)))
	UNION ALL SELECT 
        `ped`.`id` AS `pedido`,
        `cli`.`id` AS `cliente_id`,
        CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`,
        `orc`.`data_evento` AS `data_evento`,
        `orc_conv`.`id` AS `produto_id`,
        `orc_conv`.`quantidade` AS `qtd_pedido`,
        `orc_conv`.`data_entrega` AS `data_entrega`,
        `env_pap`.`gramatura` AS `gramatura`,
        `env_pap`.`quantidade` AS `qtd_papel`,
        `pap`.`id` AS `papel_id`,
        `pap`.`nome` AS `papel`,
        `pap_lin`.`nome` AS `papel_linha`,
        `pap_cat`.`nome` AS `papel_categoria`,
        `pap_dim`.`altura` AS `pap_inteiro_alt`,
        `pap_dim`.`largura` AS `pap_inteiro_larg`,
        `conv_mod`.`codigo` AS `modelo_codigo`,
        `conv_mod`.`nome` AS `modelo_nome`,
        `conv_mod`.`envelope_altura` AS `altura_final`,
        `conv_mod`.`envelope_largura` AS `larguar_final`,
        `conv_mod`.`empastamento_borda` AS `empastamento_borda`,
        0 AS `adicional`,
        NULL AS `adicional_id`,
        NULL AS `ad_produto_id`,
        'convite' AS `produto_tipo`,
        'envelope' AS `composicao`
    FROM
        ((((((((((`orcamento_convite` `orc_conv`
        JOIN `pedido` `ped` ON ((`ped`.`orcamento` = `orc_conv`.`orcamento`)))
        JOIN `orcamento` `orc` ON ((`orc`.`id` = `orc_conv`.`orcamento`)))
        JOIN `cliente` `cli` ON ((`cli`.`id` = `orc`.`cliente`)))
        JOIN `convite` `conv` ON ((`conv`.`id` = `orc_conv`.`convite`)))
        JOIN `envelope_papel` `env_pap` ON ((`env_pap`.`envelope` = `conv`.`envelope`)))
        JOIN `papel` `pap` ON ((`pap`.`id` = `env_pap`.`papel`)))
        JOIN `papel_linha` `pap_lin` ON ((`pap_lin`.`id` = `pap`.`papel_linha`)))
        JOIN `papel_catalogo` `pap_cat` ON ((`pap_cat`.`id` = `pap_lin`.`papel_catalogo`)))
        JOIN `papel_dimensao` `pap_dim` ON ((`pap_dim`.`id` = `pap`.`papel_dimensao`)))
        JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `conv`.`modelo`))) 
	UNION ALL SELECT 
        `ped`.`id` AS `pedido`,
        `cli`.`id` AS `cliente_id`,
        CONCAT(`cli`.`nome`, ' ', `cli`.`sobrenome`) AS `cliente`,
        `orc`.`data_evento` AS `data_evento`,
        `ad_conv`.`orcamento_convite` AS `produto_id`,
        `ad_conv`.`quantidade` AS `qtd_pedido`,
        `ad_conv`.`data_entrega` AS `data_entrega`,
        `env_pap`.`gramatura` AS `gramatura`,
        `env_pap`.`quantidade` AS `qtd_papel`,
        `pap`.`id` AS `papel_id`,
        `pap`.`nome` AS `papel`,
        `pap_lin`.`nome` AS `papel_linha`,
        `pap_cat`.`nome` AS `papel_categoria`,
        `pap_dim`.`altura` AS `pap_inteiro_alt`,
        `pap_dim`.`largura` AS `pap_inteiro_larg`,
        `conv_mod`.`codigo` AS `modelo_codigo`,
        `conv_mod`.`nome` AS `modelo_nome`,
        `conv_mod`.`envelope_altura` AS `altura_final`,
        `conv_mod`.`envelope_largura` AS `larguar_final`,
        `conv_mod`.`empastamento_borda` AS `empastamento_borda`,
        1 AS `adicional`,
        `ad`.`id` AS `adicional_id`,
        `ad_conv`.`id` AS `ad_produto_id`,
        'convite' AS `produto_tipo`,
        'envelope' AS `composicao`
    FROM
        ((((((((((((`adicional_convite` `ad_conv`
        JOIN `adicional` `ad` ON ((`ad`.`id` = `ad_conv`.`adicional`)))
        JOIN `orcamento_convite` `orc_conv` ON ((`orc_conv`.`id` = `ad_conv`.`orcamento_convite`)))
        JOIN `pedido` `ped` ON ((`ped`.`orcamento` = `orc_conv`.`orcamento`)))
        JOIN `orcamento` `orc` ON ((`orc`.`id` = `orc_conv`.`orcamento`)))
        JOIN `cliente` `cli` ON ((`cli`.`id` = `orc`.`cliente`)))
        JOIN `convite` `conv` ON ((`conv`.`id` = `orc_conv`.`convite`)))
        JOIN `envelope_papel` `env_pap` ON ((`env_pap`.`envelope` = `conv`.`envelope`)))
        JOIN `papel` `pap` ON ((`pap`.`id` = `env_pap`.`papel`)))
        JOIN `papel_linha` `pap_lin` ON ((`pap_lin`.`id` = `pap`.`papel_linha`)))
        JOIN `papel_catalogo` `pap_cat` ON ((`pap_cat`.`id` = `pap_lin`.`papel_catalogo`)))
        JOIN `papel_dimensao` `pap_dim` ON ((`pap_dim`.`id` = `pap`.`papel_dimensao`)))
        JOIN `convite_modelo` `conv_mod` ON ((`conv_mod`.`id` = `conv`.`modelo`)))        






--Materiais do convite cartao
select
"papel" as item, 
concat(pap.nome," ",cart_pap.gramatura,"g") as material,
cart_pap.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao
inner join papel as pap on pap.id = cart_pap.papel
where orc_conv.id = 179

union all

select 
"almofada" as item, 
pap_acab.nome as material,
cart_pap_alm.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao
inner join cartao_papel_almofada as cart_pap_alm on cart_pap_alm.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_alm.papel_acabamento
where orc_conv.id = 179

union all

select 
"corte_laser" as item, 
pap_acab.nome as material,
cart_pap_laser.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_corte_laser as cart_pap_laser on cart_pap_laser.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_laser.papel_acabamento

where orc_conv.id = 179

union all

select 
"corte_vinco" as item, 
pap_acab.nome as material,
cart_pap_corte_vinco.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_corte_vinco as cart_pap_corte_vinco on cart_pap_corte_vinco.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_corte_vinco.papel_acabamento

where orc_conv.id = 179

union all

select 
"douracao" as item, 
pap_acab.nome as material,
cart_pap_douracao.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_douracao as cart_pap_douracao on cart_pap_douracao.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_douracao.papel_acabamento

where orc_conv.id = 179

union all

select 
"empastamento" as item, 
pap_acab.nome as material,
cart_pap_emp.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_empastamento as cart_pap_emp on cart_pap_emp.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_emp.papel_acabamento

where orc_conv.id = 179

union all

select 
"faca" as item, 
pap_acab.nome as material,
cart_pap_faca.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_faca as cart_pap_faca on cart_pap_faca.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_faca.papel_acabamento

where orc_conv.id = 179

union all

select 
"laminacao" as item, 
pap_acab.nome as material,
cart_pap_laminacao.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_laminacao as cart_pap_laminacao on cart_pap_laminacao.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_laminacao.papel_acabamento

where orc_conv.id = 179

union all

select 
"relevo_seco" as item, 
pap_acab.nome as material,
cart_pap_relevo_seco.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_papel as cart_pap on cart_pap.cartao = conv.cartao

inner join cartao_papel_relevo_seco as cart_pap_relevo_seco on cart_pap_relevo_seco.cartao_papel = cart_pap.id
inner join papel_acabamento as pap_acab on pap_acab.id = cart_pap_relevo_seco.papel_acabamento

where orc_conv.id = 179

union all

select
"impressao" as item, 
concat(imp.nome," : Area ",imp_area.nome) as material,
cart_imp.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_impressao as cart_imp on cart_imp.cartao = conv.cartao
inner join impressao as imp on imp.id = cart_imp.impressao
inner join impressao_area as imp_area on imp_area.id = imp.impressao_area
where orc_conv.id = 179

union all

select
"acabamento" as item, 
acab.nome as material,
cart_acab.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_acabamento as cart_acab on cart_acab.cartao = conv.cartao
inner join acabamento as acab on acab.id = cart_acab.acabamento
where orc_conv.id = 179

union all

select
"acessorio" as item, 
aces.nome as material,
cart_aces.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite
inner join cartao_acessorio as cart_aces on cart_aces.cartao = conv.cartao
inner join acessorio as aces on aces.id = cart_aces.acessorio
where orc_conv.id = 179

union all

select
"fita" as item, 
concat(fita_material.nome," ( ", cart_fita.espessura,"mm ) : ",fita_laco.nome) as material,
cart_fita.quantidade as quantidade,
null as descricao 
from orcamento_convite as orc_conv
inner join pedido as ped on ped.orcamento = orc_conv.orcamento
inner join orcamento as orc on orc.id = ped.orcamento
inner join convite as conv on conv.id = orc_conv.convite

inner join cartao_fita as cart_fita on cart_fita.cartao = conv.cartao
inner join fita as fita on fita.id = cart_fita.fita
inner join fita_laco as fita_laco on fita_laco.id = fita.fita_laco
inner join fita_material as fita_material on fita_material.id = fita.fita_material
where orc_conv.id = 179

