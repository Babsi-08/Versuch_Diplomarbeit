import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import { FormEventHandler } from 'react';

interface Employee {
    id: number;
    name: string;
}

export default function Stempeln({ employees }: { employees: Employee[] }) {
    const { flash } = usePage().props as unknown as {
        flash: { status: string | null; typ: string | null };
    };

    const kommenForm = useForm({ employee_id: '' });
    const gehenForm = useForm({ employee_id: '' });

    const submitKommen: FormEventHandler = (e) => {
        e.preventDefault();
        kommenForm.post(route('kommen'), { onSuccess: () => kommenForm.reset() });
    };

    const submitGehen: FormEventHandler = (e) => {
        e.preventDefault();
        gehenForm.post(route('gehen'), { onSuccess: () => gehenForm.reset() });
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

                    {/* Ich komme */}
                    <form
                        onSubmit={submitKommen}
                        className="rounded-2xl bg-white p-8 shadow-sm"
                    >
                        <label className="mb-3 block text-lg font-semibold text-gray-700">
                            Ich komme
                        </label>
                        <select
                            value={kommenForm.data.employee_id}
                            onChange={(e) =>
                                kommenForm.setData('employee_id', e.target.value)
                            }
                            required
                            className="mb-5 w-full rounded-lg border-2 border-pink-100 px-4 py-3 text-lg focus:border-pink-300 focus:ring-pink-300"
                        >
                            <option value="">– Mitarbeiter wählen –</option>
                            {employees.map((employee) => (
                                <option key={employee.id} value={employee.id}>
                                    {employee.name}
                                </option>
                            ))}
                        </select>
                        <button
                            type="submit"
                            disabled={kommenForm.processing}
                            className="w-full rounded-xl bg-green-300 py-4 text-xl font-bold text-gray-800 transition hover:bg-green-400 disabled:opacity-50"
                        >
                            Kommen
                        </button>
                    </form>

                    {/* Ich gehe */}
                    <form
                        onSubmit={submitGehen}
                        className="rounded-2xl bg-white p-8 shadow-sm"
                    >
                        <label className="mb-3 block text-lg font-semibold text-gray-700">
                            Ich gehe
                        </label>
                        <select
                            value={gehenForm.data.employee_id}
                            onChange={(e) =>
                                gehenForm.setData('employee_id', e.target.value)
                            }
                            required
                            className="mb-5 w-full rounded-lg border-2 border-pink-100 px-4 py-3 text-lg focus:border-pink-300 focus:ring-pink-300"
                        >
                            <option value="">– Mitarbeiter wählen –</option>
                            {employees.map((employee) => (
                                <option key={employee.id} value={employee.id}>
                                    {employee.name}
                                </option>
                            ))}
                        </select>
                        <button
                            type="submit"
                            disabled={gehenForm.processing}
                            className="w-full rounded-xl bg-pink-300 py-4 text-xl font-bold text-gray-800 transition hover:bg-pink-400 disabled:opacity-50"
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
