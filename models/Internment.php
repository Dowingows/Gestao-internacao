<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "internment".
 *
 * @property int $id
 * @property int $operator_id
 * @property string|null $number_form_assigned_operator
 * @property string|null $provider_form_number
 * @property string|null $authorization_date
 * @property string|null $password
 * @property string|null $expiry_date_password
 * @property int $patient_id
 * @property int $hospital_applicant_id
 * @property int $professional_id
 * @property int $hospital_requested_id
 * @property string|null $suggested_hospitalization_date
 * @property string|null $service_character
 * @property string|null $regime
 * @property int|null $quantity_daily_requested
 * @property string|null $opme_usage_forecast
 * @property string|null $chemotherapy_usage_forecast
 * @property string|null $clinical_indication
 * @property string|null $cid10_1
 * @property string|null $cid10_2
 * @property string|null $cid10_3
 * @property string|null $cid10_4
 * @property string|null $accident_indication
 * @property string|null $hospital_admission_date
 * @property int|null $quantity_daily_authorized
 * @property string|null $authorized_accommodation_type
 * @property int $hospital_authorized_id
 * @property string|null $cnes_code
 * @property string|null $note
 * @property string|null $request_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Internment extends \yii\db\ActiveRecord
{

    public $operator_name;
    public $patient_name;
    public $type_name;

    public $dateFields = [
        'authorization_date',
        'expiry_date_password',
        'request_date',
        'suggested_hospitalization_date',
        'hospital_admission_date'
    ];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'hospital_authorized_id'], 'required'],
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'quantity_daily_requested', 'quantity_daily_authorized', 'hospital_authorized_id'], 'default', 'value' => null],
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'quantity_daily_requested', 'quantity_daily_authorized', 'hospital_authorized_id'], 'integer'],
            [['authorization_date', 'expiry_date_password', 'suggested_hospitalization_date', 'hospital_admission_date', 'request_date', 'created_at', 'updated_at', 'deleted_at', 'internment_id', 'operator_justification', 'requested_accommodation_type', 'type_name'], 'safe'],
            [['clinical_indication', 'note'], 'string'],
            [['number_form_assigned_operator'], 'string', 'max' => 11],
            [['provider_form_number', 'password', 'service_character', 'regime', 'opme_usage_forecast', 'chemotherapy_usage_forecast', 'cid10_1', 'cid10_2', 'cid10_3', 'cid10_4', 'accident_indication', 'authorized_accommodation_type', 'cnes_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operator_id' => 'Operadora',
            'operator_name' => 'Operadora',
            'type_name' => 'Tipo',
            'number_form_assigned_operator' => 'Nº Guia Atribuido pela Operadora',
            'provider_form_number' =>  'Nº Guia do prestador',
            'authorization_date' =>  'Data de Autorizacão',
            'password' => 'Senha',
            'expiry_date_password' => 'Data de Validade da Senha',
            'patient_id' => 'Paciente',
            'patient_name' => 'Paciente',
            'hospital_applicant_id' => 'Hospital Solicitante',
            'professional_id' => 'Profissional',
            'hospital_requested_id' => 'Hospital Solicitado',
            'suggested_hospitalization_date' => 'Data Sugerida para Internação',
            'service_character' => 'Caráter de Atendimento',
            'regime' => 'Regime de Internação',
            'quantity_daily_requested' => 'Quantidade Diária Solicitada',
            'opme_usage_forecast' => 'Previsão Uso OPME',
            'chemotherapy_usage_forecast' => 'Previsão Uso Quimioterapia',
            'clinical_indication' => 'Indicação Clínica',
            'cid10_1' => 'CID 10 Principal (Opcional)',
            'cid10_2' => 'CID 10 (2) (Opcional)',
            'cid10_3' => 'CID 10 (3) (Opcional)',
            'cid10_4' => 'CID 10 (4) (Opcional)',
            'accident_indication' => 'Indicação de Acidente (acidente ou doenca relacionada)',
            'hospital_admission_date' => 'Data da Admissão Hospitalar',
            'quantity_daily_authorized' => 'Quantidade de Diárias Autorizada',
            'authorized_accommodation_type' => 'Tipo da Acomodacão Autorizada',
            'hospital_authorized_id' => 'Hospital Autorizado',
            'cnes_code' => 'Código CNES',
            'note' => 'Observação',
            'request_date' => 'Data da Solicitação',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
            'deleted_at' => 'Removido em',
            'operator_justification' => 'Justificativa da Operadora',
            'requested_accommodation_type' => 'Tipo de Acomodação Solicitada',
        ];
    }

    public function beforeSave($insert)
    {

        $fields = $this->dateFields;

        foreach ($fields as $field) {
            if (!empty($this->{$field})) {
                $this->{$field} = implode("-", array_reverse(explode("/", $this->{$field})));
            }
        }

        return parent::beforeSave($insert);
    }

    public function isExtension()
    {
        return $this->internment_id != null;
    }

    public function getTypeName()
    {
        return $this->internment_id != null ? 'Prorrogada' : 'Normal';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Internment::class, ['id' => 'internment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtensions()
    {
        return $this->hasMany(Internment::class, ['internment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(Operator::class, ['id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessional()
    {
        return $this->hasOne(Professional::class, ['id' => 'professional_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalApplicant()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_applicant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalRequested()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_requested_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalAuthorized()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_authorized_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(Batch::class, ['id' => 'batch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternmentProcedure()
    {
        return $this->hasMany(InternmentProcedure::class, ['internment_id' => 'id']);
    }

    public static function appendGuiasTISS(array $internments, \DOMDocument $xml, &$parent)
    {
        foreach ($internments as $internment) {
            if (!empty(Internment::getGuiaTISS($internment, $xml))) {
                $parent->appendChild(Internment::getGuiaTISS($internment, $xml));
            }
        }
    }

    /*ESSE XML NÃO É DE SOLICITAÇÃO DE INTERNACAO, É O RESUMO DA INTERNAÇÃO, ALGUMAS MODIFICAÇÕES FORAM FEITAS PARA QUE ELA FUNCIONE*/
    public static function getGuiaTISS(Internment $internment, $xml)
    {
        $guiaResumoInternacao = $xml->createElement("ans:guiaResumoInternacao");

        $cabecalhoGuia = $xml->createElement("ans:cabecalhoGuia");
        $cabecalhoGuia->appendChild($xml->createElement("ans:registroANS", $internment->operator->ans_code));
        $cabecalhoGuia->appendChild($xml->createElement("ans:numeroGuiaPrestador", $internment->provider_form_number));


        $dadosAutorizacao = $xml->createElement("ans:dadosAutorizacao");
        $dadosAutorizacao->appendChild($xml->createElement("ans:numeroGuiaOperadora", $internment->number_form_assigned_operator));
        $dadosAutorizacao->appendChild($xml->createElement("ans:dataAutorizacao", $internment->authorization_date));
        $dadosAutorizacao->appendChild($xml->createElement("ans:senha", $internment->password));
        $dadosAutorizacao->appendChild($xml->createElement("ans:dataValidadeSenha", $internment->expiry_date_password));

        $dadosBeneficiario = $xml->createElement("ans:dadosBeneficiario");
        $dadosBeneficiario->appendChild($xml->createElement("ans:numeroCarteira", $internment->patient->card_id_number));

        /*DEPOIS OLHAR ISSO AQUI DE BAIXO*/

        $dadosBeneficiario->appendChild($xml->createElement("ans:atendimentoRN", 'N'));

        /*DEPOIS OLHAR ISSO AQUI DE CIMA*/

        $dadosBeneficiario->appendChild($xml->createElement("ans:nomeBeneficiario", $internment->patient->name));


        $dadosExecutante = $xml->createElement("ans:dadosExecutante");
        $contratadoExecutante = $xml->createElement("ans:contratadoExecutante");
        $contratadoExecutante->appendChild($xml->createElement("ans:cnpjContratado", $internment->hospitalApplicant->cnpj));
        $contratadoExecutante->appendChild($xml->createElement("ans:nomeContratado", $internment->hospitalApplicant->name));


        $dadosExecutante->appendChild($contratadoExecutante);
        $dadosExecutante->appendChild($xml->createElement("ans:CNES", 9999999));

        $dadosInternacao = $xml->createElement("ans:dadosInternacao");

        /* CaraterAtendimento opções: 1- Eletivo ; 2- Urgência  */

        if (!empty($internment->service_character)) {
            $dadosInternacao->appendChild($xml->createElement("ans:caraterAtendimento", $internment->service_character));
        } else {
            $dadosInternacao->appendChild($xml->createElement("ans:caraterAtendimento", 2));
        }


        /*
         * Terminologia de tipo de faturamento
         * 1- Parcial  2- Final 3- Complementar 4-Total
         */

        $dadosInternacao->appendChild($xml->createElement("ans:tipoFaturamento", '2'));

        /*Tirar dúvidas com este campo*/
        /*
         *  Solução, adicionar campos data
         * */


        $dataInicioFaturamento = date('Y-m-d', strtotime($internment->created_at));
        $dataFaturamento = date('Y-m-d', strtotime($internment->batch->created_at));

        $dadosInternacao->appendChild($xml->createElement("ans:dataInicioFaturamento", $dataInicioFaturamento));
        $dadosInternacao->appendChild($xml->createElement("ans:horaInicioFaturamento", '08:00:00'));
        $dadosInternacao->appendChild($xml->createElement("ans:dataFinalFaturamento", $dataFaturamento));
        $dadosInternacao->appendChild($xml->createElement("ans:horaFinalFaturamento", '23:00:00'));

        $tipo_internacao = $internment->internment_id == null ? '1' : '2';

        $dadosInternacao->appendChild($xml->createElement("ans:tipoInternacao", $tipo_internacao));

        /* REGIME DE INTERNAÇÃO: 1- HOSPITALAR; 2 - HOSPITAL DIA; 3 - DOMICILIAR */

        if (!empty($internment->regime_internacao)) {
            $dadosInternacao->appendChild($xml->createElement("ans:regimeInternacao", $internment->regime));
        } else {
            $dadosInternacao->appendChild($xml->createElement("ans:regimeInternacao", 1));
        }

        /*Tirar duvidas depois*/
        $dadosSaidaInternacao = $xml->createElement("ans:dadosSaidaInternacao");
        /* INDICADOR DE ACIDENTE. 0 - TRABALHO ; 1 - TRANSITO; 2 - OUTROS; 9 ACIDENTE*/
        if (!empty($internment->accident_indication)) {
            $dadosSaidaInternacao->appendChild($xml->createElement("ans:indicadorAcidente", $internment->accident_indication));
        } else {
            $dadosSaidaInternacao->appendChild($xml->createElement("ans:indicadorAcidente", 9));
        }


        /*12 significa alta melhorado. 14 alto pedido*/

        /* Solução para motivo de Encerramento colocar campo em internação */
        $dadosSaidaInternacao->appendChild($xml->createElement("ans:motivoEncerramento", '12'));


        $procedimentoExecutados = $xml->createElement("ans:procedimentosExecutados");

        $total = 0.0;

        foreach ($internment->internmentProcedure as $procReal) {
            if ($procReal->is_accountable == 1) {
                $procExec = $xml->createElement("ans:procedimentoExecutado");

                /*COMO NÃO HÁ DATA DE EXECUÇÃO NA FICHA DE SOLICITAÇÃO QUE LEO ME PEDIU PARA FAZER, COLCANDO DATA DA CRIAÇAO DA FICHA*/
                $procExec->appendChild($xml->createElement("ans:dataExecucao", date('Y-m-d', strtotime($internment->created_at))));
                $procExec->appendChild($xml->createElement("ans:horaInicial", date('H:i:s', strtotime($internment->created_at))));
                $procExec->appendChild($xml->createElement("ans:horaFinal", date('H:i:s', strtotime($internment->created_at))));

                $procedimento = $xml->createElement("ans:procedimento");
                $procedimento->appendChild($xml->createElement("ans:codigoTabela", $procReal->procedure->table));
                $procedimento->appendChild($xml->createElement("ans:codigoProcedimento", $procReal->procedure->procedure_code));
                $procedimento->appendChild($xml->createElement("ans:descricaoProcedimento", $procReal->procedure->description));

                $procExec->appendChild($procedimento);

                $procExec->appendChild($xml->createElement("ans:quantidadeExecutada", $procReal->quantity_authorized));
                $procExec->appendChild($xml->createElement("ans:reducaoAcrescimo", "1.00"));
                $procExec->appendChild($xml->createElement("ans:valorUnitario", sprintf("%.2f", $procReal->procedure_price)));
                $procExec->appendChild($xml->createElement("ans:valorTotal", sprintf("%.2f", $procReal->procedure_price * $procReal->quantity_authorized)));


                $total += ($procReal->procedure_price * $procReal->quantity_authorized);

                $procedimentoExecutados->appendChild($procExec);
            }
        }


        $valorTotal = $xml->createElement("ans:valorTotal");
        $valorTotal->appendChild($xml->createElement("ans:valorProcedimentos", sprintf("%.2f", $total)));
        $valorTotal->appendChild($xml->createElement("ans:valorDiarias", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorTaxasAlugueis", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorMateriais", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorMedicamentos", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorOPME", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorGasesMedicinais", 0.00));
        $valorTotal->appendChild($xml->createElement("ans:valorTotalGeral", sprintf("%.2f", $total)));

        /* OUTRAS DESPESAS */
        // $outrasDespesas = $xml->createElement("ans:outrasDespesas");

        // foreach ($internment->despesas as $despesa) {
        //     $xmlDespesa = $xml->createElement("ans:despesa");
        //     $xmlDespesa->appendChild($xml->createElement("ans:codigoDespesa", sprintf("%02d", $despesa->cd)));

        //     $servicosExecutados = $xml->createElement("ans:servicosExecutados");
        //     $servicosExecutados->appendChild($xml->createElement("ans:dataExecucao", $despesa->data));
        //     $servicosExecutados->appendChild($xml->createElement("ans:horaInicial", $despesa->hora_inicio));
        //     $servicosExecutados->appendChild($xml->createElement("ans:horaFinal", $despesa->hora_final));

        //     $codigoTabela = "";
        //     $codigoProcedimento = "";
        //     if (!empty($despesa->procedimento->id)) {
        //         $codigoTabela = $despesa->procedimento->tabela;
        //         $codigoProcedimento = $despesa->procedimento->codigo_procedimento;
        //     } else if (!empty($despesa->medicamento->id)) {
        //         $codigoTabela = 20;
        //         $codigoProcedimento = $despesa->medicamento->cod_tiss;
        //     } else if (!empty($despesa->material->id)) {
        //         $codigoTabela = 19;
        //         $codigoProcedimento = $despesa->material->cod_tnumm;
        //     }

        //     $servicosExecutados->appendChild($xml->createElement("ans:codigoTabela", $codigoTabela));


        //     if (!empty($codigoProcedimento)) {
        //         /*ESPECIAL POR CONTA DA ESCOLHA ENTRE MEDICAMENTOS; MATERIAIS DESCARTAVEIS E PROCEDIMENTOS*/
        //         $servicosExecutados->appendChild($xml->createElement("ans:codigoProcedimento", $codigoProcedimento));
        //     }
        //     /*END ESPECIAL POR CONTA DA ESCOLHA ENTRE MEDICAMENTOS; MATERIAIS DESCARTAVEIS E PROCEDIMENTOS*/

        //     $servicosExecutados->appendChild($xml->createElement("ans:quantidadeExecutada", $despesa->qtd));

        //     /* PÇ = 044 na tabela de dominio 60*/

        //     $servicosExecutados->appendChild($xml->createElement("ans:unidadeMedida", '044'));

        //     if (!empty($despesa->fator_red_acresc)) {
        //         $servicosExecutados->appendChild($xml->createElement("ans:reducaoAcrescimo", $despesa->fator_red_acresc));
        //     } else {
        //         $servicosExecutados->appendChild($xml->createElement("ans:reducaoAcrescimo", "1.00"));
        //     }

        //     $servicosExecutados->appendChild($xml->createElement("ans:valorUnitario", $despesa->valor_unitario));
        //     $servicosExecutados->appendChild($xml->createElement("ans:valorTotal", sprintf("%.2f", $despesa->valor_unitario * $despesa->qtd)));

        //     $descricaoProcedimento = 'indefinido';
        //     /*UMA DESPESA PODE TER UM DESTES TRÊS: MEDICAMENTO, PROCEDIMENTO OU MATERIAL*/
        //     if (!empty($despesa->medicamento->descricao)) {
        //         $descricaoProcedimento = $despesa->medicamento->descricao;
        //     } else if (!empty($despesa->procedimento->descricao)) {
        //         $descricaoProcedimento = $despesa->procedimento->descricao;
        //     } else if (!empty($despesa->material->descricao)) {
        //         $descricaoProcedimento = $despesa->material->descricao;
        //     }

        //     $servicosExecutados->appendChild($xml->createElement("ans:descricaoProcedimento", $descricaoProcedimento));
        //     $xmlDespesa->appendChild($servicosExecutados);
        //     $outrasDespesas->appendChild($xmlDespesa);
        // }

        $guiaResumoInternacao->appendChild($cabecalhoGuia);

        /*SE NÃO ACHAR ACHAR A GUIA PRINCIPAL, USA O PROPRIO NÚMERO DA GUIA PARA REALIZAR ESSA TAREFA!  */
        if (!empty($internment->num_guia_solic_internacao))
            $guiaResumoInternacao->appendChild($xml->createElement("ans:numeroGuiaSolicitacaoInternacao", $internment->num_guia_solic_internacao));
        else
            $guiaResumoInternacao->appendChild($xml->createElement("ans:numeroGuiaSolicitacaoInternacao", $internment->provider_form_number));


        $guiaResumoInternacao->appendChild($dadosAutorizacao);

        $guiaResumoInternacao->appendChild($dadosBeneficiario);
        $guiaResumoInternacao->appendChild($dadosExecutante);
        $guiaResumoInternacao->appendChild($dadosInternacao);
        $guiaResumoInternacao->appendChild($dadosSaidaInternacao);
        $guiaResumoInternacao->appendChild($procedimentoExecutados);
        $guiaResumoInternacao->appendChild($valorTotal);
        // $guiaResumoInternacao->appendChild($outrasDespesas);


        return $guiaResumoInternacao;
    }


    public static function generateXML($batch, $operadora_id)
    {
        $internacoes = $batch->internments;

        if (empty($operadora = Operator::findOne($operadora_id))) {
            return false;
        }

        if (empty($hospital = Hospital::findOne(1))) {
            return false;
        }

        $dom = new \DOMDocument("1.0", "utf-8");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        /* ROOT DO ARQUIVO XML */

        $root = $dom->createElementNS("http://www.ans.gov.br/padroes/tiss/schemas", "ans:mensagemTISS");
        $root->setAttribute("xmlns", "http://www.w3.org/2001/XMLSchema");
        // $root->setAttributeNS("http://www.w3.org/2001/XMLSchema","http://www.ans.gov.br/padroes/tiss/schemas",'xmlns:ans');
        /* HEADER  */
        $header = $dom->createElement("ans:cabecalho");

        $transacao = $dom->createElement("ans:identificacaoTransacao");
        //valores exemplo
        $transacao->appendChild($dom->createElement("ans:tipoTransacao", "ENVIO_LOTE_GUIAS"));

        $sequencialTransacao = date('Ymd') . sprintf("%04d", date("H"));
        $dataRegistroTransacao = date('Y-m-d', strtotime($batch->created_at));
        $horaRegistroTransacao = date('H:i:s', strtotime($batch->created_at)) . '.0000000-03:00';

        $transacao->appendChild($dom->createElement("ans:sequencialTransacao", $sequencialTransacao));
        $transacao->appendChild($dom->createElement("ans:dataRegistroTransacao", $dataRegistroTransacao));
        $transacao->appendChild($dom->createElement("ans:horaRegistroTransacao", $horaRegistroTransacao));

        $origem = $dom->createElement("ans:origem");
        $identificacaoPrestador = $dom->createElement("ans:identificacaoPrestador");
        $identificacaoPrestador->appendChild($dom->createElement("ans:CNPJ", $hospital->cnpj));
        $origem->appendChild($identificacaoPrestador);

        $destino = $dom->createElement("ans:destino");
        $destino->appendChild($dom->createElement("ans:registroANS", $operadora->ans_code));

        $padrao = $dom->createElement("ans:Padrao", '3.03.01');

        $header->appendChild($transacao);
        $header->appendChild($origem);
        $header->appendChild($destino);
        $header->appendChild($padrao);

        /* END HEADER */

        /* PRESTADOR PARA OPERADORA */


        $numeroLote = date('Ym') . sprintf("%06d", $batch->id);

        $prestadorParaOperadora = $dom->createElement("ans:prestadorParaOperadora");
        $loteGuias = $dom->createElement("ans:loteGuias");
        $loteGuias->appendChild($dom->createElement("ans:numeroLote", $numeroLote));

        $guiasTISS = $dom->createElement("ans:guiasTISS");

        Internment::appendGuiasTISS($internacoes, $dom, $guiasTISS);

        $loteGuias->appendChild($guiasTISS);

        $prestadorParaOperadora->appendChild($loteGuias);

        //colocar aqui as guias geradas atraves das fichas

        /* END PRESTADOR PARA OPERADORA */

        $epilogo = $dom->createElement("ans:epilogo");
        $epilogo->appendChild($dom->createElement("ans:hash", $batch->hash));

        $root->appendChild($header);
        $root->appendChild($prestadorParaOperadora);
        $root->appendChild($epilogo);

        $dom->appendChild($root);

        return $dom->saveXML();
    }
}
