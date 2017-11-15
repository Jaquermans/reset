<?php
    declare(strict_types=1);
    namespace reset\datasources;
    use be\kunstmaan\multichain\MultichainClient;
    use be\kunstmaan\multichain\MultichainHelper;

    class multichain
    {
        /** @var MultichainClient */
        protected $multichain;
        /** @var  MultichainHelper */
        protected $helper;

        public function setUp()
        {
            $this->multichain = new MultichainClient(getenv('JSON_RPC_URL'), getenv('JSON_RPC_USERNAME'), getenv('JSON_RPC_PASSWORD'), 3);
            //$this->helper = new MultichainHelper($this->multichain);
        }

        /**
         * 	Returns general information about this node and blockchain. MultiChain adds some fields to Bitcoin Core’s
         * response, giving the blockchain’s chainname, description, protocol, peer-to-peer port. The setupblocks field
         * gives the length in blocks of the setup phase in which some consensus constraints are not applied. The
         * nodeaddress can be passed to other nodes for connecting.
         *
         * @group info
         */
        public function testGetInfo()
        {
            $info = $this->multichain->setDebug(true)->getInfo();
        }

        public function execute($fetchFlag = FALSE)
        {
            return array(200,$this->testGetInfo());
        }
    }
