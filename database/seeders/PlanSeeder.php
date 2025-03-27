<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Laravelcm\Subscriptions\Interval;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Free Plan
        $freePlan = Plan::create([
            'name' => [
                'en' => 'Free',
                'ar' => 'الخطة المجانية'
            ],
            'description' => [
                'en' => 'The Free plan provides limited access to some essential features.',
                'ar' => 'الخطة المجانية توفر وصولًا محدودًا لبعض الميزات الأساسية.'
            ],
            'price' => 0.00,
            'signup_fee' => 0.00,
            'currency' => 'USD',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'grace_period' => 0,
            'grace_interval' => 'day',
            'is_active' => true,
            'prorate_day' => null,
            'prorate_period' => null,
            'prorate_extend_due' => null,
            'active_subscribers_limit' => null,
        ]);

        // Create features for Free Plan
        $this->createFeatures($freePlan, [
            [
                'name' => [
                    'en' => 'AI Chat for Trading & Investment Advisory',
                    'ar' => 'الدردشة مع الذكاء الاصطناعي'
                ],
                'description' => [
                    'en' => 'Access to AI chat for trading and investment advice',
                    'ar' => 'الوصول إلى الدردشة مع الذكاء الاصطناعي للتداول والاستشارات الاستثمارية'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Recommendations',
                    'ar' => 'توصيات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock recommendations',
                    'ar' => 'الحصول على توصيات الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Trading Simulations',
                    'ar' => 'محاكاة التداول'
                ],
                'description' => [
                    'en' => 'Run AI-powered trading simulations',
                    'ar' => 'تشغيل محاكاة التداول المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 2,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Predictions',
                    'ar' => 'توقعات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock price predictions',
                    'ar' => 'الحصول على توقعات أسعار الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 2,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI News Analysis',
                    'ar' => 'تحليل الأخبار'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of financial news',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي للأخبار المالية'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Portfolio Optimization',
                    'ar' => 'تحسين المحفظة'
                ],
                'description' => [
                    'en' => 'Get AI-powered optimization of your investment portfolio',
                    'ar' => 'الحصول على تحسين مدعوم بالذكاء الاصطناعي لمحفظة استثماراتك'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Strategy Analysis',
                    'ar' => 'تحليل الاستراتيجيات'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of your trading strategies',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي لاستراتيجيات التداول الخاصة بك'
                ],
                'value' => 2,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Risk Management',
                    'ar' => 'إدارة المخاطر'
                ],
                'description' => [
                    'en' => 'Get AI-powered risk management for your investments',
                    'ar' => 'الحصول على إدارة مخاطر مدعومة بالذكاء الاصطناعي لاستثماراتك'
                ],
                'value' => 2,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Market Sentiment Alerts',
                    'ar' => 'تنبيهات معنويات السوق'
                ],
                'description' => [
                    'en' => 'Receive alerts about market sentiment changes',
                    'ar' => 'تلقي تنبيهات حول تغيرات معنويات السوق'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Smart Notifications System',
                    'ar' => 'نظام الإشعارات'
                ],
                'description' => [
                    'en' => 'Receive smart notifications about your investments',
                    'ar' => 'تلقي إشعارات ذكية حول استثماراتك'
                ],
                'value' => 5,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
        ]);

        // Standard Plan
        $standardPlan = Plan::create([
            'name' => [
                'en' => 'Standard',
                'ar' => 'الخطة القياسية'
            ],
            'description' => [
                'en' => 'The Standard plan offers limited features at an affordable price for regular investors.',
                'ar' => 'الخطة القياسية توفر ميزات محدودة بتكلفة منخفضة للمستثمرين العاديين.'
            ],
            'price' => 29.99,
            'signup_fee' => 0.00,
            'currency' => 'USD',
            'trial_period' => 14,
            'trial_interval' => 'day',
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'grace_period' => 3,
            'grace_interval' => 'day',
            'is_active' => true,
            'prorate_day' => null,
            'prorate_period' => null,
            'prorate_extend_due' => null,
            'active_subscribers_limit' => null,
        ]);

        // Create features for Standard Plan
        $this->createFeatures($standardPlan, [
            [
                'name' => [
                    'en' => 'AI Chat for Trading & Investment Advisory',
                    'ar' => 'الدردشة مع الذكاء الاصطناعي'
                ],
                'description' => [
                    'en' => 'Access to AI chat for trading and investment advice',
                    'ar' => 'الوصول إلى الدردشة مع الذكاء الاصطناعي للتداول والاستشارات الاستثمارية'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Recommendations',
                    'ar' => 'توصيات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock recommendations',
                    'ar' => 'الحصول على توصيات الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Trading Simulations',
                    'ar' => 'محاكاة التداول'
                ],
                'description' => [
                    'en' => 'Run AI-powered trading simulations',
                    'ar' => 'تشغيل محاكاة التداول المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 7,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Predictions',
                    'ar' => 'توقعات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock price predictions',
                    'ar' => 'الحصول على توقعات أسعار الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 7,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI News Analysis',
                    'ar' => 'تحليل الأخبار'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of financial news',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي للأخبار المالية'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Portfolio Optimization',
                    'ar' => 'تحسين المحفظة'
                ],
                'description' => [
                    'en' => 'Get AI-powered optimization of your investment portfolio',
                    'ar' => 'الحصول على تحسين مدعوم بالذكاء الاصطناعي لمحفظة استثماراتك'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Strategy Analysis',
                    'ar' => 'تحليل الاستراتيجيات'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of your trading strategies',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي لاستراتيجيات التداول الخاصة بك'
                ],
                'value' => 7,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Risk Management',
                    'ar' => 'إدارة المخاطر'
                ],
                'description' => [
                    'en' => 'Get AI-powered risk management for your investments',
                    'ar' => 'الحصول على إدارة مخاطر مدعومة بالذكاء الاصطناعي لاستثماراتك'
                ],
                'value' => 7,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Market Sentiment Alerts',
                    'ar' => 'تنبيهات معنويات السوق'
                ],
                'description' => [
                    'en' => 'Receive alerts about market sentiment changes',
                    'ar' => 'تلقي تنبيهات حول تغيرات معنويات السوق'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Smart Notifications System',
                    'ar' => 'نظام الإشعارات'
                ],
                'description' => [
                    'en' => 'Receive smart notifications about your investments',
                    'ar' => 'تلقي إشعارات ذكية حول استثماراتك'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
        ]);

        // Professional Plan
        $professionalPlan = Plan::create([
            'name' => [
                'en' => 'Professional',
                'ar' => 'الخطة المهنية'
            ],
            'description' => [
                'en' => 'The Professional plan offers advanced features for serious investors and traders.',
                'ar' => 'الخطة المهنية توفر ميزات متقدمة للمستثمرين والمتداولين الجادين.'
            ],
            'price' => 79.99,
            'signup_fee' => 0.00,
            'currency' => 'USD',
            'trial_period' => 7,
            'trial_interval' => 'day',
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'grace_period' => 5,
            'grace_interval' => 'day',
            'is_active' => true,
            'prorate_day' => null,
            'prorate_period' => null,
            'prorate_extend_due' => null,
            'active_subscribers_limit' => null,
        ]);

        // Create features for Professional Plan
        $this->createFeatures($professionalPlan, [
            [
                'name' => [
                    'en' => 'AI Chat for Trading & Investment Advisory',
                    'ar' => 'الدردشة مع الذكاء الاصطناعي'
                ],
                'description' => [
                    'en' => 'Access to AI chat for trading and investment advice',
                    'ar' => 'الوصول إلى الدردشة مع الذكاء الاصطناعي للتداول والاستشارات الاستثمارية'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Recommendations',
                    'ar' => 'توصيات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock recommendations',
                    'ar' => 'الحصول على توصيات الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Trading Simulations',
                    'ar' => 'محاكاة التداول'
                ],
                'description' => [
                    'en' => 'Run AI-powered trading simulations',
                    'ar' => 'تشغيل محاكاة التداول المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Predictions',
                    'ar' => 'توقعات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock price predictions',
                    'ar' => 'الحصول على توقعات أسعار الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI News Analysis',
                    'ar' => 'تحليل الأخبار'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of financial news',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي للأخبار المالية'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Portfolio Optimization',
                    'ar' => 'تحسين المحفظة'
                ],
                'description' => [
                    'en' => 'Get AI-powered optimization of your investment portfolio',
                    'ar' => 'الحصول على تحسين مدعوم بالذكاء الاصطناعي لمحفظة استثماراتك'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Strategy Analysis',
                    'ar' => 'تحليل الاستراتيجيات'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of your trading strategies',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي لاستراتيجيات التداول الخاصة بك'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Risk Management',
                    'ar' => 'إدارة المخاطر'
                ],
                'description' => [
                    'en' => 'Get AI-powered risk management for your investments',
                    'ar' => 'الحصول على إدارة مخاطر مدعومة بالذكاء الاصطناعي لاستثماراتك'
                ],
                'value' => 15,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Market Sentiment Alerts',
                    'ar' => 'تنبيهات معنويات السوق'
                ],
                'description' => [
                    'en' => 'Receive alerts about market sentiment changes',
                    'ar' => 'تلقي تنبيهات حول تغيرات معنويات السوق'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Smart Notifications System',
                    'ar' => 'نظام الإشعارات'
                ],
                'description' => [
                    'en' => 'Receive smart notifications about your investments',
                    'ar' => 'تلقي إشعارات ذكية حول استثماراتك'
                ],
                'value' => 30,
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
        ]);

        // Enterprise Plan
        $enterprisePlan = Plan::create([
            'name' => [
                'en' => 'Enterprise',
                'ar' => 'الخطة المؤسسية'
            ],
            'description' => [
                'en' => 'The Enterprise plan offers unlimited access to all premium features for professional traders and institutions.',
                'ar' => 'الخطة المؤسسية توفر وصولاً غير محدود لجميع الميزات المتميزة للمتداولين المحترفين والمؤسسات.'
            ],
            'price' => 199.99,
            'signup_fee' => 0.00,
            'currency' => 'USD',
            'trial_period' => 7,
            'trial_interval' => 'day',
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'grace_period' => 7,
            'grace_interval' => 'day',
            'is_active' => true,
            'prorate_day' => null,
            'prorate_period' => null,
            'prorate_extend_due' => null,
            'active_subscribers_limit' => null,
        ]);

        // Create features for Enterprise Plan
        $this->createFeatures($enterprisePlan, [
            [
                'name' => [
                    'en' => 'AI Chat for Trading & Investment Advisory',
                    'ar' => 'الدردشة مع الذكاء الاصطناعي'
                ],
                'description' => [
                    'en' => 'Access to AI chat for trading and investment advice',
                    'ar' => 'الوصول إلى الدردشة مع الذكاء الاصطناعي للتداول والاستشارات الاستثمارية'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Recommendations',
                    'ar' => 'توصيات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock recommendations',
                    'ar' => 'الحصول على توصيات الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Trading Simulations',
                    'ar' => 'محاكاة التداول'
                ],
                'description' => [
                    'en' => 'Run AI-powered trading simulations',
                    'ar' => 'تشغيل محاكاة التداول المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Stock Predictions',
                    'ar' => 'توقعات الأسهم'
                ],
                'description' => [
                    'en' => 'Get AI-powered stock price predictions',
                    'ar' => 'الحصول على توقعات أسعار الأسهم المدعومة بالذكاء الاصطناعي'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI News Analysis',
                    'ar' => 'تحليل الأخبار'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of financial news',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي للأخبار المالية'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Portfolio Optimization',
                    'ar' => 'تحسين المحفظة'
                ],
                'description' => [
                    'en' => 'Get AI-powered optimization of your investment portfolio',
                    'ar' => 'الحصول على تحسين مدعوم بالذكاء الاصطناعي لمحفظة استثماراتك'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Strategy Analysis',
                    'ar' => 'تحليل الاستراتيجيات'
                ],
                'description' => [
                    'en' => 'Get AI-powered analysis of your trading strategies',
                    'ar' => 'الحصول على تحليل مدعوم بالذكاء الاصطناعي لاستراتيجيات التداول الخاصة بك'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'AI Risk Management',
                    'ar' => 'إدارة المخاطر'
                ],
                'description' => [
                    'en' => 'Get AI-powered risk management for your investments',
                    'ar' => 'الحصول على إدارة مخاطر مدعومة بالذكاء الاصطناعي لاستثماراتك'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Market Sentiment Alerts',
                    'ar' => 'تنبيهات معنويات السوق'
                ],
                'description' => [
                    'en' => 'Receive alerts about market sentiment changes',
                    'ar' => 'تلقي تنبيهات حول تغيرات معنويات السوق'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
            [
                'name' => [
                    'en' => 'Smart Notifications System',
                    'ar' => 'نظام الإشعارات'
                ],
                'description' => [
                    'en' => 'Receive smart notifications about your investments',
                    'ar' => 'تلقي إشعارات ذكية حول استثماراتك'
                ],
                'value' => 50, // Unlimited
                'resettable_period' => 1,
                'resettable_interval' => Interval::DAY->value,
            ],
        ]);
    }

    /**
     * Create features for a plan
     *
     * @param Plan $plan
     * @param array $features
     * @return void
     */
    private function createFeatures(Plan $plan, array $features): void
    {
        foreach ($features as $feature) {
            $plan->features()->create($feature);
        }
    }
}
