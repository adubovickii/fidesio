<?php

namespace Magecom\Donation\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magecom\Donation\Api\DonationManagerInterface;
use Magento\Quote\Model\QuoteIdMask;
use Magento\Quote\Model\QuoteIdMaskFactory;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Cart\Totals;


/**
 * Class DonationManager
 *
 * @package Magecom\Donation\Model
 */
class DonationManager implements DonationManagerInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * Quote repository.
     *
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var Totals
     */
    protected $totals;

    /**
     * Constructs a coupon read service object.
     *
     * @param CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        CartRepositoryInterface $quoteRepository,
        Totals $totals,
        QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->totals = $totals;
    }

    /**
     * Set donation to quote.
     *
     * @param string $donationCost
     * @param string $cartId
     *
     * @return bool|mixed
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function set($donationCost, $cartId)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');

        if ($quoteId = $quoteIdMask->getQuoteId()) {
            /** @var  \Magento\Quote\Model\Quote $quote */
            $quote = $this->quoteRepository->getActive($quoteId);

            if (!$quote->getItemsCount()) {
                throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
            }

            try {
                $quote->setDonation($donationCost);
                $this->quoteRepository->save($quote->collectTotals());
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__('Could not apply donation'));
            }

            return true;
        }
    }

    /**
     * Remove donation form quote.
     *
     * @param string $cartId
     *
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function remove($cartId)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');

        if ($quoteId = $quoteIdMask->getQuoteId()) {
            /** @var  \Magento\Quote\Model\Quote $quote */
            $quote = $this->quoteRepository->getActive($quoteId);
            if (!$quote->getItemsCount()) {
                throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
            }

            try {
                $quote->setDonation(null);
                $this->quoteRepository->save($quote->collectTotals());
            } catch (\Exception $e) {
                throw new CouldNotDeleteException(__('Could not delete donation'));
            }

            return true;
        }
    }
}