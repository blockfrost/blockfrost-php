<?php

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertTrue;


use Blockfrost\Page;
use Blockfrost\Transaction\TransactionsService;
use Blockfrost\Transaction\Transaction;
use Blockfrost\Transaction\TransactionAmount;
use Blockfrost\Transaction\TransactionUTXOs;
use Blockfrost\Transaction\TransactionUTXOInput;
use Blockfrost\Transaction\TransactionUTXOOutput;




//https://phpunit.readthedocs.io/en/9.5/fixtures.html

final class TransactionServiceTest extends TestCase
{
    var $service;

    public function setUp():void
    {
        $this->service = new TransactionsService(TransactionsService::$NETWORK_CARDANO_TESTNET, getenv('TEST_ID_TESTNET') );
    }
    
    public function test_transaction_willReturn_transactionForAHash():void
    {
        $ta = new TransactionAmount();
        $ta->unit = "lovelace";
        $ta->quantity = "9605414089839";
        
        
        $expectedTransaction = new Transaction();
        $expectedTransaction->hash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        $expectedTransaction->block= "dc6258ab8b0cbbe04343f31c71062058fcb9bc9f7ae47085d43a39ee4688a878";
        $expectedTransaction->block_height =2750303;
        $expectedTransaction->slot =31814522;
        $expectedTransaction->index =3; 
        $expectedTransaction->output_amount = [$ta];
        $expectedTransaction->fees = "168801";
        $expectedTransaction->deposit = "0";
        $expectedTransaction->size = 293;
        $expectedTransaction->invalid_before = null;
        $expectedTransaction->invalid_hereafter = "31821502";
        $expectedTransaction->utxo_count = 3;
        $expectedTransaction->withdrawal_count = 0;
        $expectedTransaction->mir_cert_count = 0;
        $expectedTransaction->delegation_count = 0; 
        $expectedTransaction->stake_cert_count = 0;
        $expectedTransaction->pool_retire_count = 0; 
        $expectedTransaction->pool_update_count = 0;
        $expectedTransaction->asset_mint_or_burn_count = 0;
        $expectedTransaction->block_time = 1626183738;
        $expectedTransaction->redeemer_count = 0;
        $expectedTransaction->valid_contract = true;


        $transactionHash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        
        $transactionResponse = $this->service->getTransaction($transactionHash);
        
        $this->assertEquals($expectedTransaction, $transactionResponse);
    }

    
    public function test_transactionUtxo_willReturn_transactionUtxoForAHash():void
    {
        $to = new TransactionAmount();
        $to->unit = "lovelace";
        $to->quantity = "9605414258640";
        
        $input = new TransactionUTXOInput();
        $input->address = "addr_test1qqk2fygtqcusmx9djys2r7m4emslwy8hfjllrakd5777hzcxu2hyfhlkwuxupa9d5085eunq2qywy7hvmvej456flknstkhmyt";
        $input->tx_hash = "59b051e130d32fa2d316b0ee50934d10f1a8e9af332166812bd696a755727fec";
        $input->output_index = 1;
        $input->amount = [$to];
        
        $to0 = new TransactionAmount();
        $to0->unit = "lovelace";
        $to0->quantity=  "1000000000";
        
        $to1 = new TransactionAmount();
        $to1->unit = "lovelace";
        $to1->quantity=  "9604414089839";
        
        $output0 = new TransactionUTXOOutput();
        $output0->address = "addr_test1qqy07jaue8tru20877ak7wxpuagrqqpm2pdacfjjtv4z3elcn8dnk52656jspgq03ts2sl6jvefwakdacwfy605m9ydselehdg";
        $output0->amount = [$to0];
        $output0->output_index  =0;
        
        $output1 = new TransactionUTXOOutput();
        $output1->address = "addr_test1qq4sa7kg02ms66nsx6d06q4h697p57ajla2eedfl0aysqrgxu2hyfhlkwuxupa9d5085eunq2qywy7hvmvej456flknsyznauy";
        $output1->amount = [$to1];
        $output1->output_index  =1;
        
        $expectedTransactionUtxo = new TransactionUTXOs();
        $expectedTransactionUtxo->hash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        $expectedTransactionUtxo->inputs = [$input];
        $expectedTransactionUtxo->outputs = [$output0, $output1];
        
        $transactionHash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        
        $transactionUtxoResponse = $this->service->getTransactionUTXOs($transactionHash);
        
        $this->assertEquals($expectedTransactionUtxo, $transactionUtxoResponse);

    }

    
    public function test_transactionStakes_willReturn_transactionStakesForAHash():void
    {
        $transactionHash = "1ff10222ed3448350472e0cf457f2d7959370d5d0b8545775602ac3c8ce2fa69";
        $transactionStakeResponse = $this->service->getTransactionStakeAddressCertificates($transactionHash);
        
        $this->assertEquals(1, count($transactionStakeResponse) );
    }

    
    public function test_transactionDelegations_willReturn_transactionDelegationsForAHash():void
    {

        $transactionHash = "09f45427ecbc7770bdc4e722790b60e0b32713588127635b54b726a16b7cdb7c";
        $transactionDelegationResponse = $this->service->getTransactionDelegationCertificates($transactionHash);
        
        $this->assertEquals(1, count($transactionDelegationResponse) );
    }

    
    public function test_transactionWithdrawals_willReturn_transactionWithdrawalsForAHash():void
    {
        $transactionHash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        $transactionWithdrawalResponse = $this->service->getTransactionWithdrawals($transactionHash);
        
        $this->assertEquals(0, count($transactionWithdrawalResponse) );
    }

    
    public function test_transactionMirs_willReturn_transactionMirsForAHash():void
    {
        $transactionHash = "8c14901968f453b759e59d8ae06beaf507ae47a2b15e225c6bbab0092cf4b71f";
        $transactionMirResponse = $this->service->getTransactionMIRs($transactionHash);
        
        $this->assertEquals(3, count($transactionMirResponse) );
    }

    
    public function test_transactionPoolUpdates_willReturn_transactionPoolUpdatesForAHash():void
    {
        $transactionHash = "0089e962584516378463141d853f7102852e7f2a8546c2a2af6cc05c6e628a5b";
        $transactionPoolUpdateResponse = $this->service->getTransactionStakePoolUpdateCertificates($transactionHash);
        
        $this->assertEquals(0, count($transactionPoolUpdateResponse) );
    }


    public function test_transactionPoolRetires_willReturn_transactionPoolRetiresForAHash():void
    {
        $transactionHash = "e704195363899c1116d8088250343186873f7e4d9d20aee105de929ece54efa8";
        $transactionPoolRetireResponse = $this->service->getTransactionStakePoolRetirementCertificates($transactionHash);
        
        $this->assertEquals(1, count($transactionPoolRetireResponse) );
    }

    
    public function test_transactionMetadata_willReturn_transactionMetadataForAHash():void
    {
        $transactionHash = "9ca2321264072dfc9bbb7755ad9fbcae80d548c2609eba80b5de426af3f85245";
        $transactionMetadataJsonResponse = $this->service->getTransactionMetadata($transactionHash);
        
        $this->assertEquals(1, count($transactionMetadataJsonResponse) );
    }

    
    public function test_transactionMetadataCbor_willReturn_transactionMetadataCborForAHash():void
    {
        $transactionHash = "9ca2321264072dfc9bbb7755ad9fbcae80d548c2609eba80b5de426af3f85245";
        $transactionMetadataCborResponse = $this->service->getTransactionMetadataAsCBOR($transactionHash);
        
        $this->assertEquals(1, count($transactionMetadataCborResponse) );
    }

    
    public function test_transactionPost_willThrow_badRequest():void
    {
        $this->expectExceptionMessage("StreamInterface");
        
        $signedTxn = "83a5008182582009569e9528465d287124f9082e48e333bf3e7643274b33b03f1bcd91210d5ce1010182825839001c1ffaf141ebbb8e3a7072bb15f50f938b994c82de2d175f358fc942441f00edfe1b8d6a84f0d19c25a9c8829442160c0b5c758094c423441a0016e360825839008c5bf0f2af6f1ef08bb3f6ec702dd16e1c514b7e1d12f7549b47db9f4d943c7af0aaec774757d4745d1a2c8dd3220e6ec2c9df23f757a2f8821a737666a9b818581c06f8c5655b4e2b5911fee8ef2fc66b4ce64c8835642695c730a3d108a443617364183f4364646416437364730448746f6b656e5f313218b2581c159bc4f577978a7240d03dbf4b28722fbff1fe4ba37435e94acbaa26a24002436162630e581c2984b98bab844a0302fed0dab5c787db8f75543f09d9499239e15136a14974657374746f6b656e1a00030d3b581c308177c8d1c7017a7bd4a7971152e7f4cd1f76759febc1fa12613700a14a73656c66746f6b656e311a000249f0581c329728f73683fe04364631c27a7912538c116d802416ca1eaf2d7a96a147736174636f696e1b000000012a040f7c581c47101e3f5d731ce43eaa81f6b09e119e8792fc59b952d5f6051ace69a14974657374746f6b656e1a00030d3b581c4c0ba27aaa43124c6205dcc1314cce1f297ad734877c6523ae7ff6aaa14974657374746f6b656e1a00030d40581c52babbdbf74b3661703376e592733d099510b8f0163c98effc3c18d5a2436162630c4474657374190d05581c5fe03ede2b378777f68f6b4c4ec47692a6e5bc2af80de3a1781d3296a14a73656c66746f6b656e311a0003d090581c689903d80b71e0570fea2fdaaa4bf80989785ed2a2cd57da0d9a7d0aa148746f6b656e5f31321a0002e9be581c6b248bf1bbfac692610ca7e9873f988dc5e358b9229be8d6363aedd3a1474d59546f6b656e1b0000002e90edd000581c6b8d07d69639e9413dd637a1a815a7323c69c86abbafb66dbfdb1aa7a14002581c6c6e472b55ad49736568153e7b91d67b1b28a66eb80eb39526d3d247a14364646603581c6e0d4cf285768594d0611ac0bc8e5c213c740296b76e4b78157b5db2a14967696674746f6b656e1a0007a120581c7180cf30d4f4db3037bd815f89f0b348a10e31e11f0a40e6993c8189a144594f5550190bb8581c7cc0fd78dd44e38a928109fc7baf60a9e3f1ef530c9840e542cfee93a14974657374746f6b656e1a00030d40581c8617488dde7b8b39881e6034dbd30860c7313d65014f203ed3e57a74a2436162631903e84378797a1907d0581c8bb9f400ee6ec7c81c5afa2c656945c1ab06785b9751993653441e32a144544553541a00053d8a581cb9bd3fb4511908402fbef848eece773bb44c867c25ac8c08d9ec3313a144696e746a1a00030d40581cbfa2e9636c9df09279d21ad14baf84ff4f6c10cc84f61b2388db3e81a14974657374746f6b656e1a00030d40581cc56f63b1522fbf46fefa6c199aebba42a04e9ff99204cc0b9f557abea2474554546f6b656e190bb8475154546f6b656e192ee0581cc7127649494037a76d9e53b5e9b848b347a624983e5c6c7649f49941a2435454310a4354543214581cdd60cac16a3647149cfbefd16e1635e700a18ed5473b7103acb04d23a14a73656c66746f6b656e311a0003d090581ce1ae600b1e0e2dde90ff4749d192524b6f7d6e08ba8b99afceacab2ba14873656c66676966741a0001867e021a000388fd031a0221fc5c07582079906018ae50cbed76c2f89382f504036ff43b935ee8488eb51884f9fd4f13cda100838258209518c18103cbdab9c6e60b58ecc3e2eb439fef6519bb22570f391327381900a85840421c08b09388b625a6c538afbe6276f5f44487ac8804eab12568f793b41e86591838fde0403e65424b6e85dfe00f13ee83ad31adc779ae0de98acaaa6155dd0f825820be334d13759f7e3a81954b942ff370e518b7d7074cb12aae551ca7ae93a6198e58400f0b0b7c929537b6a915e55454b4c8eb5f4ed7e4364e817d08ed91c6682ba9b9e1f8346e487c48ff83d244f39885d348c676f26061a1f5e8795233efb5a08d0b8258209518c18103cbdab9c6e60b58ecc3e2eb439fef6519bb22570f391327381900a85840421c08b09388b625a6c538afbe6276f5f44487ac8804eab12568f793b41e86591838fde0403e65424b6e85dfe00f13ee83ad31adc779ae0de98acaaa6155dd0fa61bf710c72e671fae4ba01b0d205105e6e7bacf504ebc4ea3b43bb0cc76bb326f17a30d8f1b12c2c4e58b6778f6a26430783065463bdefda922656830783134666638643a00c87ed21b6827b4dcb50c5c0b71726365486c5578586c576d5a4a637859641b64f4d10bda83efe33a584ddab21b12127f810d7dcee28264554a42333a00f7bf93";

        $this->service->submitTransaction($signedTxn);
        
    }
}






