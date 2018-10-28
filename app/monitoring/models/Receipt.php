<?php
namespace LPPMKP\Monitoring\Models;
//use Phalcon\Validation;
//use Phalcon\Validation\Validator\Email as EmailValidator;

class Receipt extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="receiptId", type="integer", length=11, nullable=false)
     */
    public $receiptId;

    /**
     *
     * @var string
     * @Column(column="receiptName", type="varchar", length=50, nullable=true)
     */
    public $receiptName;

    /**
     *
     * @var string
     * @Column(column="receiptNIP", type="varchar", length=30, nullable=true)
     */
    public $receiptNIP;

    /**
     *
     * @var string
     * @Column(column="receiptLocation", type="varchar", length=255, nullable=true)
     */
    public $receiptLocation;

    /**
     *
     * @var string
     * @Column(column="receiptDateDepart", type="date", nullable=true)
     */
    public $receiptDateDepart;

    /**
     *
     * @var string
     * @Column(column="receiptDateReturn", type="date", nullable=true)
     */
    public $receiptDateReturn;

    /**
     *
     * @var string
     * @Column(column="receiptNoSPB", type="integer", length=11, nullable=true)
     */
    public $receiptNoSPB;

    /**
     *
     * @var string
     * @Column(column="receiptDetail", type="string", nullable=true)
     */
    public $receiptDetail;

    /**
     *
     * @var string
     * @Column(column="receiptDetailReal", type="string", nullable=false)
     */
    public $receiptDetailReal;


//    /**
//     * Validations and business logic
//     *
//     * @return boolean
//     */
//    public function validation()
//    {
//        $validator = new Validation();
//
//        $validator->add(
//            'email',
//            new EmailValidator(
//                [
//                    'model'   => $this,
//                    'message' => 'Please enter a correct email address',
//                ]
//            )
//        );
//
//        return $this->validate($validator);
//    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("receipt");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'receipt';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Receipt[]|Receipt|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Receipt|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
