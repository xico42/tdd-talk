<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<nfeProc xmlns="http://www.portalfiscal.inf.br/nfe" versao="4.00">
    <NFe>
        <infNFe versao="4.00" Id="NFe{{ $nfeAccessKey }}">
            <ide>
                <cUF>33</cUF>
                <cNF>00068344</cNF>
                <natOp>Venda de mercadorias</natOp>
                <mod>55</mod>
                <serie>1</serie>
                <nNF>{{ $nfeNumber }}</nNF>
                <dhEmi>{{ $nfeEmissionDate }}T12:40:00-03:00</dhEmi>
                <dhSaiEnt>2021-07-09T12:40:00-03:00</dhSaiEnt>
                <tpNF>1</tpNF>
                <idDest>1</idDest>
                <cMunFG>3302403</cMunFG>
                <tpImp>1</tpImp>
                <tpEmis>1</tpEmis>
                <cDV>2</cDV>
                <tpAmb>1</tpAmb>
                <finNFe>1</finNFe>
                <indFinal>1</indFinal>
                <indPres>0</indPres>
                <procEmi>0</procEmi>
                <verProc>5.0</verProc>
            </ide>
            <emit>
                <CNPJ>{{ $companyCnpj }}</CNPJ>
                <xNome>Comacharque Comercio de Maquinas e Equip. Ltda EPP</xNome>
                <xFant>Comacharque</xFant>
                <enderEmit>
                    <xLgr>ALCIDES MOURAO</xLgr>
                    <nro>600</nro>
                    <xBairro>Aroeira</xBairro>
                    <cMun>3302403</cMun>
                    <xMun>Macae</xMun>
                    <UF>RJ</UF>
                    <CEP>27945402</CEP>
                    <cPais>1058</cPais>
                    <xPais>BRASIL</xPais>
                    <fone>2227620367</fone>
                </enderEmit>
                <IE>75880162</IE>
                <CRT>1</CRT>
            </emit>
            <dest>
                <CNPJ>{{ $receiverDocument }}</CNPJ>
                <xNome>{{ $receiverName }}</xNome>
                <enderDest>
                    <xLgr>RUA ALCIDES MOURAO</xLgr>
                    <nro>592</nro>
                    <xBairro>AROEIRA</xBairro>
                    <cMun>3302403</cMun>
                    <xMun>Macae</xMun>
                    <UF>RJ</UF>
                    <CEP>27945401</CEP>
                    <cPais>1058</cPais>
                    <xPais>BRASIL</xPais>
                    <fone>2227624765</fone>
                </enderDest>
                <indIEDest>1</indIEDest>
                <IE>85381601</IE>
                <email>sss@gmail.com</email>
            </dest>
            <det nItem="1">
                <prod>
                    <cProd>003132</cProd>
                    <cEAN>7899908759775</cEAN>
                    <xProd>REFRIGERADOR VERTICAL 572L 220V VB52AH METALFRIO</xProd>
                    <NCM>84185090</NCM>
                    <CEST>2100700</CEST>
                    <CFOP>5102</CFOP>
                    <uCom>UN</uCom>
                    <qCom>1.0000</qCom>
                    <vUnCom>6280.2400000000</vUnCom>
                    <vProd>6280.24</vProd>
                    <cEANTrib>7899908759775</cEANTrib>
                    <uTrib>UN</uTrib>
                    <qTrib>1.0000</qTrib>
                    <vUnTrib>6280.2400000000</vUnTrib>
                    <indTot>1</indTot>
                </prod>
                <imposto>
                    <vTotTrib>0.00</vTotTrib>
                    <ICMS>
                        <ICMSSN102>
                            <orig>0</orig>
                            <CSOSN>102</CSOSN>
                        </ICMSSN102>
                    </ICMS>
                    <PIS>
                        <PISOutr>
                            <CST>99</CST>
                            <vBC>0.00</vBC>
                            <pPIS>0.0000</pPIS>
                            <vPIS>0.00</vPIS>
                        </PISOutr>
                    </PIS>
                    <COFINS>
                        <COFINSOutr>
                            <CST>99</CST>
                            <vBC>0.00</vBC>
                            <pCOFINS>0.0000</pCOFINS>
                            <vCOFINS>0.00</vCOFINS>
                        </COFINSOutr>
                    </COFINS>
                </imposto>
                <infAdProd>Referencia: VB52AHD001</infAdProd>
            </det>
            <total>
                <ICMSTot>
                    <vBC>0.00</vBC>
                    <vICMS>0.00</vICMS>
                    <vICMSDeson>0.00</vICMSDeson>
                    <vFCPUFDest>0.00</vFCPUFDest>
                    <vICMSUFDest>0.00</vICMSUFDest>
                    <vICMSUFRemet>0.00</vICMSUFRemet>
                    <vFCP>0.00</vFCP>
                    <vBCST>0.00</vBCST>
                    <vST>0.00</vST>
                    <vFCPST>0.00</vFCPST>
                    <vFCPSTRet>0.00</vFCPSTRet>
                    <vProd>6280.24</vProd>
                    <vFrete>0.00</vFrete>
                    <vSeg>0.00</vSeg>
                    <vDesc>0.00</vDesc>
                    <vII>0.00</vII>
                    <vIPI>0.00</vIPI>
                    <vIPIDevol>0.00</vIPIDevol>
                    <vPIS>0.00</vPIS>
                    <vCOFINS>0.00</vCOFINS>
                    <vOutro>0.00</vOutro>
                    <vNF>{{ $nfeValue }}</vNF>
                    <vTotTrib>0.00</vTotTrib>
                </ICMSTot>
            </total>
            <transp>
                <modFrete>9</modFrete>
                <vol>
                    <pesoL>0.000</pesoL>
                    <pesoB>0.000</pesoB>
                </vol>
            </transp>
            <cobr>
                <fat>
                    <nFat>{{ $nfeNumber }}</nFat>
                    <vOrig>{{ $nfeValue }}</vOrig>
                    <vDesc>0.00</vDesc>
                    <vLiq>6280.24</vLiq>
                </fat>

                @foreach ($duplicates as $duplicate)
                <dup>
                    <nDup>{{ $duplicate['number'] }}</nDup>
                    <dVenc>{{ $duplicate['dueDate'] }}</dVenc>
                    <vDup>{{ $duplicate['value'] }}</vDup>
                </dup>
                @endforeach
            </cobr>
            <pag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
                <detPag>
                    <tPag>05</tPag>
                    <vPag>785.03</vPag>
                </detPag>
            </pag>
            <infAdic>
                <infCpl>Trib aprox R$: 0,00 Fed.  e 0,00 Est. Fonte:</infCpl>
            </infAdic>
        </infNFe>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
            <SignedInfo>
                <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
                <Reference URI="#NFe{{ $nfeAccessKey }}">
                    <Transforms>
                        <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                        <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                    </Transforms>
                    <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                    <DigestValue>YDaq9GpyfU1yNEiYl/1zEqo3iRk=</DigestValue>
                </Reference>
            </SignedInfo>
            <SignatureValue>wNliCvBZOcDheZwFh2g3FyOGT6GJEIjfgdqcu0EIdOtg8FVsqC0zB+8CVPZ4c27xybuGIeCIuPkXc61RgIRxfloJvVEwE0ZD+JB8C5I4rYTzlgcPJz/qvxTg79sd44ooAyUKl/g/VDlF+iFhUI+vXr/Zacf1DUEhy4gESbf9isZ1IqLbZRDuzHT9hRIfYMk/tffssITr1+kVUfKi5F0LuVrcVHesLa3ytuonVEXpNqdyK9+sUDkCIzk5bcMUYjy0ssw7qlbnZ9t+Oufmr/SbwXe3iXZeRo+9T6QaC8bbxTYkhpaH521y6xKgcMsUto7fsuc4XHknSUd6NL7O9Nm1IA==</SignatureValue>
            <KeyInfo>
                <X509Data>
                    <X509Certificate>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</X509Certificate>
                </X509Data>
            </KeyInfo>
        </Signature>
    </NFe>
    <protNFe versao="4.00">
        <infProt>
            <tpAmb>1</tpAmb>
            <verAplic>SVRS202103291658</verAplic>
            <chNFe>{{ $nfeAccessKey }}</chNFe>
            <dhRecbto>2021-07-09T12:40:03-03:00</dhRecbto>
            <nProt>333210110011665</nProt>
            <digVal>YDaq9GpyfU1yNEiYl/1zEqo3iRk=</digVal>
            <cStat>100</cStat>
            <xMotivo>Autorizado o uso da NF-e</xMotivo>
        </infProt>
    </protNFe>
</nfeProc>
