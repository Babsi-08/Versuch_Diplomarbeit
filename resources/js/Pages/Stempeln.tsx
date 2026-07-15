import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

export default function Stempeln() {
    const { auth, flash } = usePage().props as unknown as {
        auth: { user: { name: string } };
        flash: { status: string | null; typ: string | null };
    };

    const kommenForm = useForm({});
    const gehenForm = useForm({});

    const submitKommen: FormEventHandler = (e) => {
        e.preventDefault();
        kommenForm.post(route('kommen'));
    };

    const submitGehen: FormEventHandler = (e) => {
        e.preventDefault();
        gehenForm.post(route('gehen'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Stempeluhr
                </h2>
            }
        >
            <Head title="Stempeluhr" />

            <div className="py-12">
                <div className="mx-auto max-w-xl space-y-6 sm:px-6 lg:px-8">
                    <p className="text-center text-lg text-gray-600">
                        Angemeldet als{' '}
                        <span className="font-semibold text-gray-900">
                            {auth.user.name}
                        </span>
                    </p>

                    {flash?.status && (
                        <div
                            className={
                                'rounded-lg border-l-8 px-6 py-4 text-lg font-medium ' +
                                (flash.typ === 'gehen'
                                    ? 'border-pink-400 bg-pink-100 text-pink-900'
                                    : 'border-green-400 bg-green-100 text-green-900')
                            }
                        >
                            {flash.status}
                        </div>
                    )}

                    <form onSubmit={submitKommen} className="rounded-2xl bg-white p-8 shadow-sm">
                        <p className="mb-4 text-lg font-semibold text-gray-700">
                            Ich komme
                        </p>
                        <button
                            type="submit"
                            disabled={kommenForm.processing}
                            className="w-full rounded-xl bg-green-200 py-4 text-xl font-bold text-gray-800 transition hover:bg-green-300 disabled:opacity-50"
                        >
                            Kommen
                        </button>
                    </form>

                    <form onSubmit={submitGehen} className="rounded-2xl bg-white p-8 shadow-sm">
                        <p className="mb-4 text-lg font-semibold text-gray-700">
                            Ich gehe
                        </p>
                        <button
                            type="submit"
                            disabled={gehenForm.processing}
                            className="w-full rounded-xl bg-pink-200 py-4 text-xl font-bold text-gray-800 transition hover:bg-pink-300 disabled:opacity-50"
                        >
                            Gehen
                        </button>
                    </form>

                    <Link
                        href={route('uebersicht')}
                        className="block text-center text-lg font-medium text-pink-700 hover:text-pink-900"
                    >
                        Übersicht ansehen →
                    </Link>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
