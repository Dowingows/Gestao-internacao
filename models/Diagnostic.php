<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "diagnostic".
 *
 * @property int $id
 * @property int $operator_id
 * @property string|null $accident_indication
 * @property string|null $ans_code
 * @property string|null $number_form_main
 * @property string|null $authorization_date
 * @property string|null $expiry_date_password
 * @property string|null $password
 * @property string|null $number_form_assigned_operator
 * @property int $patient_id
 * @property int $professional_id
 * @property string|null $service_character
 * @property string|null $request_date
 * @property string|null $clinical_indication
 * @property string|null $contractor_name
 * @property string|null $contracted_operator_code
 * @property string|null $executor_contractor_name
 * @property string|null $cod_operator_executing
 * @property string|null $service_type
 * @property string|null $type_medical_appointment
 * @property string|null $provider_form_number
 * @property string|null $reason_closing_service
 * @property int $contractor_applicant_id
 * @property int $contractor_executor_id
 * @property string|null $note
 */
class Diagnostic extends \yii\db\ActiveRecord
{
    public $operator_name;
    public $patient_name;

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
        return 'diagnostic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'required'],
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'default', 'value' => null],
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'integer'],
            [['authorization_date', 'expiry_date_password', 'password','request_date'], 'safe'],
            [['note'], 'string'],
            [['accident_indication', 'ans_code', 'service_character', 'contractor_name', 'contracted_operator_code', 'cod_operator_executing', 'service_type', 'type_medical_appointment', 'provider_form_number', 'reason_closing_service'], 'string', 'max' => 50],
            [['number_form_main', 'number_form_assigned_operator'], 'string', 'max' => 11],
            [['clinical_indication'], 'string', 'max' => 100],
            [['executor_contractor_name'], 'string', 'max' => 255],
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
            'accident_indication' => 'Indicador de Acidente',
            'ans_code' => 'Registro ANS',
            'number_form_main' => 'Nº Guia Principal',
            'authorization_date' => 'Data de Autorizacão',
            'password' => 'Senha',
            'expiry_date_password' => 'Data de Validade da Senha',
            'number_form_assigned_operator' => 'Nº Guia Atribuido pela Operadora',
            'patient_id' => 'Paciente',
            'patient_name' => 'Paciente',
            'professional_id' => 'Profissional',
            'service_character' => 'Caráter de Atendimento',
            'request_date' => 'Data de Solicitacão',
            'clinical_indication' => 'Indicacão Clínica',
            'contractor_name' => 'Nome do Contratado',
            'contracted_operator_code' => 'Codigo Operadora Contratado',
            'executor_contractor_name' => 'Nome Contratado Executante',
            'cod_operator_executing' => 'Codigo Operador Executante',
            'service_type' => 'Tipo de Atendimento',
            'type_medical_appointment' => 'Tipo Consulta',
            'provider_form_number' => 'Nº Guia do prestador',
            'reason_closing_service' => 'Motivo de encerramento do Atendimento',
            'contractor_applicant_id' => 'Contratado Solicitante',
            'contractor_executor_id' => 'Contratado Executante',
            'note' => 'Observação',
        ];
    }

    public function beforeSave($insert) {
        $fields = ['authorization_date', 'expiry_date_password', 'request_date'];
        foreach($fields as $field){
            if(!empty($this->{$field})){
                $this->{$field} = implode("-", array_reverse(explode("/", $this->{$field})));
            }  
        }
         
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticProcedure()
    {
        return $this->hasMany(DiagnosticProcedure::class, ['diagnostic_id' => 'id']);
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
    public function getProfessional()
    {
        return $this->hasOne(Professional::class, ['id' => 'professional_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorExecutor()
    {
        return $this->hasOne(Hospital::class, ['id' => 'contractor_executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorApplicant()
    {
        return $this->hasOne(Hospital::class, ['id' => 'contractor_applicant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }


    
    public static function appendGuiasTISS(array  $diagnosticList, \DOMDocument $xml, &$parent)
    {
        foreach ( $diagnosticList as  $diagnostic) {
            if (!empty(Diagnostic::getGuiaTISS( $diagnostic, $xml)))
                $parent->appendChild(Diagnostic::getGuiaTISS( $diagnostic, $xml));
        }
    }

    public static function getGuiaTISS(Diagnostic  $diagnostic, $xml)
    {

        $guiaSP_SADT = $xml->createElement("ans:guiaSP-SADT");

        $cabecalhoGuia = $xml->createElement("ans:cabecalhoGuia");
        $cabecalhoGuia->appendChild($xml->createElement("ans:registroANS",  $diagnostic->operator->ans_code));
        $cabecalhoGuia->appendChild($xml->createElement("ans:numeroGuiaPrestador",  $diagnostic->number_form_main));


        $dadosAutorizacao = $xml->createElement("ans:dadosAutorizacao");
        $dadosAutorizacao->appendChild($xml->createElement("ans:numeroGuiaOperadora",  $diagnostic->number_form_assigned_operator));
        $dadosAutorizacao->appendChild($xml->createElement("ans:dataAutorizacao",  $diagnostic->authorization_date));
        $dadosAutorizacao->appendChild($xml->createElement("ans:senha",  $diagnostic->password));
        $dadosAutorizacao->appendChild($xml->createElement("ans:dataValidadeSenha",  $diagnostic->expiry_date_password));

        $dadosBeneficiario = $xml->createElement("ans:dadosBeneficiario");
        $dadosBeneficiario->appendChild($xml->createElement("ans:numeroCarteira",  $diagnostic->patient->card_id_number));
        /*DEPOIS OLHAR ISSO AQUI DE BAIXO*/
        $dadosBeneficiario->appendChild($xml->createElement("ans:atendimentoRN", 'N'));
        /*DEPOIS OLHAR ISSO AQUI DE CIMA*/
        $dadosBeneficiario->appendChild($xml->createElement("ans:nomeBeneficiario",  $diagnostic->patient->name));


        $dadosSolicitante = $xml->createElement("ans:dadosSolicitante");
        $contratadoSolicitante = $xml->createElement("ans:contratadoSolicitante");
        $contratadoSolicitante->appendChild($xml->createElement("ans:cnpjContratado",  $diagnostic->contractorApplicant->cnpj));
        $contratadoSolicitante->appendChild($xml->createElement("ans:nomeContratado",  $diagnostic->contractorApplicant->name));

        $profissionalSolicitante = $xml->createElement("ans:profissionalSolicitante");
        $profissionalSolicitante->appendChild($xml->createElement("ans:nomeProfissional",  $diagnostic->professional->name));
        $profissionalSolicitante->appendChild($xml->createElement("ans:conselhoProfissional",  $diagnostic->professional->council));
        $profissionalSolicitante->appendChild($xml->createElement("ans:numeroConselhoProfissional",  $diagnostic->professional->council_number));
        $profissionalSolicitante->appendChild($xml->createElement("ans:UF",  $diagnostic->professional->uf));
        $profissionalSolicitante->appendChild($xml->createElement("ans:CBOS",  $diagnostic->professional->cbo_code));

        $dadosSolicitante->appendChild($contratadoSolicitante);
        $dadosSolicitante->appendChild($profissionalSolicitante);


        $dadosSolicitacao = $xml->createElement("ans:dadosSolicitacao");
        $dadosSolicitacao->appendChild($xml->createElement("ans:dataSolicitacao",  $diagnostic->request_date));

        /* CaraterAtendimento opções: 1- Eletivo ; 2- Urgência  */
        if (!empty( $diagnostic->service_character)) {
            $dadosSolicitacao->appendChild($xml->createElement("ans:caraterAtendimento",  $diagnostic->service_character));
        } else {
            $dadosSolicitacao->appendChild($xml->createElement("ans:caraterAtendimento", 2));
        }

        $dadosSolicitacao->appendChild($xml->createElement("ans:indicacaoClinica",  $diagnostic->clinical_indication));

        $dadosExecutante = $xml->createElement("ans:dadosExecutante");
        $contratadoExecutante = $xml->createElement("ans:contratadoExecutante");
        $contratadoExecutante->appendChild($xml->createElement("ans:cnpjContratado",  $diagnostic->contractorApplicant->cnpj));
        $contratadoExecutante->appendChild($xml->createElement("ans:nomeContratado",  $diagnostic->contractorApplicant->name));

        $dadosExecutante->appendChild($contratadoExecutante);
        $dadosExecutante->appendChild($xml->createElement("ans:CNES", 9999999));

        $dadosAtendimento = $xml->createElement("ans:dadosAtendimento");
        $dadosAtendimento->appendChild($xml->createElement("ans:tipoAtendimento", sprintf("%02d",  $diagnostic->service_type)));

        /* INDICADOR DE ACIDENTE. 0 - TRABALHO ; 1 - TRANSITO; 2 - OUTROS; 9 ACIDENTE*/
        if (!empty( $diagnostic->indicacao_acidente)) {
            $dadosAtendimento->appendChild($xml->createElement("ans:indicacaoAcidente",  $diagnostic->accident_indication));
        } else {
            $dadosAtendimento->appendChild($xml->createElement("ans:indicacaoAcidente", 9));
        }

        /*12 significa alta melhorado. 14 alto pedido*/

        /* Solução para motivo de Encerramento colocar campo em internação */
        //   $dadosAtendimento->appendChild($xml->createElement("ans:motivoEncerramento", '11'));

        $procedimentosExecutados = $xml->createElement("ans:procedimentosExecutados");
               
        foreach ($diagnostic->diagnosticProcedure as $procDiag) {

            $procedimentoExecutado = $xml->createElement("ans:procedimentoExecutado");

            $procedimentoXMLNode = $xml->createElement("ans:procedimento");

            $procedimentoExecutado->appendChild($xml->createElement("ans:dataExecucao", date('Y-m-d', strtotime( $diagnostic->created_at))));
            $procedimentoExecutado->appendChild($xml->createElement("ans:horaInicial", date('H:i:s', strtotime( $diagnostic->created_at))));
            $procedimentoExecutado->appendChild($xml->createElement("ans:horaFinal", date('H:i:s', strtotime( $diagnostic->created_at))));

            $procedimentoXMLNode->appendChild($xml->createElement("ans:codigoTabela", $procDiag->procedure->table));
            $procedimentoXMLNode->appendChild($xml->createElement("ans:codigoProcedimento", $procDiag->procedure->procedure_code));
            $procedimentoXMLNode->appendChild($xml->createElement("ans:descricaoProcedimento", $procDiag->procedure->description));

            $procedimentoExecutado->appendChild($procedimentoXMLNode);

            $procedimentoExecutado->appendChild($xml->createElement("ans:quantidadeExecutada", $procDiag->quantity_requested));

            $procedimentoExecutado->appendChild($xml->createElement("ans:reducaoAcrescimo", "1.00"));
            $procedimentoExecutado->appendChild($xml->createElement("ans:valorUnitario", $procDiag->quantity_requested));

            $valorTotalProcedimento = $procDiag->quantity_authorized * $procDiag->procedure_price;

            $procedimentoExecutado->appendChild($xml->createElement("ans:valorTotal", $valorTotalProcedimento));

            $procedimentosExecutados->appendChild($procedimentoExecutado);

        }


        $guiaSP_SADT->appendChild($cabecalhoGuia);
        $guiaSP_SADT->appendChild($dadosAutorizacao);
        $guiaSP_SADT->appendChild($dadosBeneficiario);
        $guiaSP_SADT->appendChild($dadosSolicitante);
        $guiaSP_SADT->appendChild($dadosSolicitacao);
        $guiaSP_SADT->appendChild($dadosExecutante);
        $guiaSP_SADT->appendChild($dadosAtendimento);
        $guiaSP_SADT->appendChild($procedimentosExecutados);

        $guiaSP_SADT->appendChild($xml->createElement("ans:observacao",  $diagnostic->note));

        $total = 0.0;

        foreach ( $diagnostic->diagnosticProcedure as $pd) {

            $quant = $pd->quantity_authorized;
            $val = $pd->procedure_price;

            $total += $quant * $val;
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


        $guiaSP_SADT->appendChild($valorTotal);


        return $guiaSP_SADT;

    }

    public static function generateXML($lote, $operator_id)
    {

         $diagnosticList = $lote->diagnostics;

        if (empty($operadora = Operator::findOne($operator_id))) {
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

        /* HEADER  */
        $header = $dom->createElement("ans:cabecalho");

        $transacao = $dom->createElement("ans:identificacaoTransacao");
        //valores exemplo
        $transacao->appendChild($dom->createElement("ans:tipoTransacao", "ENVIO_LOTE_GUIAS"));

        $sequencialTransacao = date('Ymd') . sprintf("%04d", date("H"));
        $dataRegistroTransacao = date('Y-m-d', strtotime($lote->created_at));
        $horaRegistroTransacao = date('H:i:s', strtotime($lote->created_at)) . '.0000000-03:00';

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


        $batchNumber = date('Ym') . sprintf("%06d", $lote->id);

        $prestadorParaOperadora = $dom->createElement("ans:prestadorParaOperadora");
        $loteGuias = $dom->createElement("ans:loteGuias");
        $loteGuias->appendChild($dom->createElement("ans:numeroLote", $batchNumber));

        $guiasTISS = $dom->createElement("ans:guiasTISS");

        Diagnostic::appendGuiasTISS( $diagnosticList, $dom, $guiasTISS);

        $loteGuias->appendChild($guiasTISS);

        $prestadorParaOperadora->appendChild($loteGuias);

        //colocar aqui as guias geradas atraves das fichas

        /* END PRESTADOR PARA OPERADORA */

        $epilogo = $dom->createElement("ans:epilogo");
        $epilogo->appendChild($dom->createElement("ans:hash", $lote->hash));

        $root->appendChild($header);
        $root->appendChild($prestadorParaOperadora);
        $root->appendChild($epilogo);

        $dom->appendChild($root);

        return $dom->saveXML();
    }

}
