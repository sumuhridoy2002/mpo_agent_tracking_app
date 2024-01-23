<?php

namespace App\Traits;

/**
 * Trait for handling Dashboard Data response.
 *
 * @author Hridoy
 */
trait DashboardDataResponseTrait
{
    /**
     * Send Dashboard Data Response.
     *
     * @return array
     */
    protected function DashboardDataResponse(): array
    {
        return [
            'total_sales'          => 5000000,
            'total_commision'      => 20000,
            'total_doctor_visited' => 1065,
            'total_doctor_onboard' => 65,
            'current_target'       => [
                'title'            => 'New year target 2024.',
                'agents_count'     => 5,
                'target_amount'    => 270000,
                'amount_collected' => 125000
            ],
            'chart_data'           => [
                [
                    'agent_name'       => 'Demo agent 1',
                    'amount_collected' => 10000
                ],
                [
                    'agent_name'       => 'Demo agent 2',
                    'amount_collected' => 12500
                ],
                [
                    'agent_name'       => 'Demo agent 3',
                    'amount_collected' => 7200
                ]
            ]
        ];
    }
}