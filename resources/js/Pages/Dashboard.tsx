import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You're logged in!
                        </div>
                    </div>

                    <Link
                        href={route('stempeln')}
                        className="block overflow-hidden rounded-lg bg-white shadow-sm transition hover:shadow-md"
                    >
                        <div className="p-6">
                            <h3 className="text-lg font-semibold text-gray-900">
                                Stempeluhr öffnen →
                            </h3>
                            <p className="mt-1 text-sm text-gray-600">
                                Kommen und Gehen erfassen sowie die Übersicht ansehen.
                            </p>
                        </div>
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
